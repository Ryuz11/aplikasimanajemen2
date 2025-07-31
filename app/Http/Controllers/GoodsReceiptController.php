<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use App\Models\PurchaseOrder;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\AuditLog;

class GoodsReceiptController extends Controller
{
    public function index()
    {
        $goodsReceipts = GoodsReceipt::with(['purchaseOrder'])->orderByDesc('created_at')->paginate(10);
        return View::make('goods_receipts.index', compact('goodsReceipts'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('warehouse')) {
            abort(403, 'Hanya user warehouse yang dapat melakukan penerimaan barang.');
        }
        $purchaseOrders = \App\Models\PurchaseOrder::where('status', 'sent')->get();
        $barangs = \App\Models\Barang::all();
        return View::make('goods_receipts.create', compact('purchaseOrders', 'barangs'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('warehouse')) {
            abort(403, 'Hanya user warehouse yang dapat melakukan penerimaan barang.');
        }
        $items = collect($request->input('items', []))
            ->filter(fn($item) => !empty($item['barang_id']) && !empty($item['jumlah_diterima']) && intval($item['jumlah_diterima']) > 0)
            ->values();

        $validated = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'kondisi' => 'required|in:barang bagus,barang rusak,barang kadaluarsa',
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
        ]);

        if ($items->isEmpty()) {
            return back()->withErrors(['items' => 'Pilih minimal satu barang dan isi qty.'])->withInput();
        }

        foreach ($items as $idx => $item) {
            $request->validate([
                "items.$idx.barang_id" => 'required|exists:barangs,id',
                "items.$idx.jumlah_diterima" => 'required|integer|min:1',
                "items.$idx.keterangan" => 'nullable|string',
            ]);
        }

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_grn', 'public');
        }

        $goodsReceipt = GoodsReceipt::create([
            'purchase_order_id' => $validated['purchase_order_id'],
            'tanggal' => $validated['tanggal'],
            'kondisi' => $validated['kondisi'],
            'bukti' => $buktiPath,
            'status' => 'pending',
            'received_by' => Auth::id(),
        ]);

        foreach ($items as $item) {
            \App\Models\GoodsReceiptItem::create([
                'goods_receipt_id' => $goodsReceipt->id,
                'barang_id' => $item['barang_id'],
                'jumlah_diterima' => $item['jumlah_diterima'],
                'keterangan' => $item['keterangan'] ?? null,
            ]);
        }

        return Redirect::route('goods-receipts.index')->with('success', 'GRN berhasil dibuat.');
    }

    public function approve(GoodsReceipt $goodsReceipt)
    {
        if (!auth()->user()->hasRole('warehouse')) {
            abort(403, 'Hanya user warehouse yang dapat approve GRN.');
        }
        DB::transaction(function () use ($goodsReceipt) {
            $goodsReceipt->update(['status' => 'approved']);
            // Update stok barang hanya jika GRN approved
            $barang = $goodsReceipt->barang;
            $barang->stok += $goodsReceipt->qty;
            $barang->save();
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'approve_grn',
                'description' => 'Approve GRN ID: ' . $goodsReceipt->id,
            ]);
        });
        return Redirect::route('goods-receipts.index')->with('success', 'GRN disetujui & stok diperbarui.');
    }

    public function reject(GoodsReceipt $goodsReceipt)
    {
        $goodsReceipt->update(['status' => 'rejected']);
        return Redirect::route('goods-receipts.index')->with('success', 'GRN ditolak.');
    }

    public function show(GoodsReceipt $goodsReceipt)
    {
        $goodsReceipt->load(['purchaseOrder', 'items.barang']);
        return view('goods_receipts.show', ['grn' => $goodsReceipt]);
    }
}
