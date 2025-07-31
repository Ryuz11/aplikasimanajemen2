<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequest;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function view;
use function redirect;
use function back;
use function now;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('purchaseRequest', 'items.barang')->latest()->paginate(10);
        $firstPurchaseRequest = \App\Models\PurchaseRequest::first();
        return view('purchase_orders.index', compact('purchaseOrders', 'firstPurchaseRequest'));
    }

    public function create(Request $request)
    {
        $prId = $request->get('pr_id');
        $purchaseRequests = PurchaseRequest::where('status', 'approved')->with('barang')->get();
        $purchaseRequest = null;
        $barangs = collect();
        if ($prId) {
            $purchaseRequest = $purchaseRequests->where('id', $prId)->first();
            if ($purchaseRequest) {
                $barangs = collect([$purchaseRequest->barang]);
            }
        }
        return view('purchase_orders.create', compact('purchaseRequests', 'purchaseRequest', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_request_id' => 'required|exists:purchase_requests,id',
            'supplier_name' => 'required',
            'order_date' => 'required|date',
            'items' => 'required|array',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $po = PurchaseOrder::create([
                'purchase_request_id' => $request->purchase_request_id,
                'po_number' => 'PO-' . now()->format('YmdHis'),
                'status' => 'draft',
                'supplier_name' => $request->supplier_name,
                'order_date' => $request->order_date,
            ]);

            foreach ($request->items as $item) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $po->id,
                    'barang_id' => $item['barang_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] ?? 0,
                ]);
            }
        });

        return redirect()->route('purchase-orders.index')->with('success', 'Purchase Order berhasil dibuat.');
    }

    public function show($id)
    {
        $po = PurchaseOrder::with('purchaseRequest', 'items.barang')->findOrFail($id);
        return view('purchase_orders.show', compact('po'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,sent,complete',
        ]);
        $po = PurchaseOrder::findOrFail($id);
        $po->status = $request->status;
        $po->save();
        return back()->with('success', 'Status PO diperbarui.');
    }
}
