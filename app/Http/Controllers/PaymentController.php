<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Models\GoodsReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['purchaseOrder', 'goodsReceipt', 'user'])->orderByDesc('created_at')->paginate(10);
        return View::make('payments.index', compact('payments'));
    }

    public function create()
    {
        $purchaseOrders = PurchaseOrder::where('status', 'sent')->get();
        // Ambil hanya GRN yang belum pernah dibayar (tidak ada payment dengan status 'paid' untuk GRN tsb)
        $goodsReceipts = \App\Models\GoodsReceipt::whereDoesntHave('payment', function($q) {
            $q->where('status', 'paid');
        })->get();
        return View::make('payments.create', compact('purchaseOrders', 'goodsReceipts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'goods_receipt_id' => 'required|exists:goods_receipts,id',
            'invoice_number' => 'required|string|max:100',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);
        Payment::create([
            'purchase_order_id' => $validated['purchase_order_id'],
            'goods_receipt_id' => $validated['goods_receipt_id'],
            'invoice_number' => $validated['invoice_number'],
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'status' => 'pending',
            'paid_by' => Auth::id(),
        ]);
        return Redirect::route('payments.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,rejected',
        ]);
        $payment->update(['status' => $validated['status']]);

        // Jika status menjadi paid, update stok barang dari PO
        if ($validated['status'] === 'paid') {
            $po = $payment->purchaseOrder;
            if ($po) {
                foreach ($po->items as $item) {
                    $barang = $item->barang;
                    if ($barang) {
                        $barang->stok += $item->quantity;
                        $barang->save();
                    }
                }
            }
        }
        return Redirect::route('payments.index')->with('success', 'Status pembayaran diperbarui.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['purchaseOrder', 'goodsReceipt', 'user']);
        return view('payments.show', compact('payment'));
    }
}
