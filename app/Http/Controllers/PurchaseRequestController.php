<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = PurchaseRequest::with(['barang', 'user']);
        if ($user->hasRole('warehouse')) {
            $query->where('requested_by', $user->id);
        }
        $purchaseRequests = $query->orderByDesc('created_at')->paginate(10);
        return View::make('purchase_requests.index', compact('purchaseRequests'));
    }

    public function create()
    {
        $barangs = \App\Models\Barang::all();
        return View::make('purchase_requests.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'qty' => 'required|integer|min:1',
        ]);
        // Validasi barang harus terdaftar
        $barang = \App\Models\Barang::find($validated['barang_id']);
        if (!$barang) {
            return Redirect::back()->withErrors(['barang_id' => 'Barang belum terdaftar.']);
        }
        PurchaseRequest::create([
            'barang_id' => $validated['barang_id'],
            'qty' => $validated['qty'],
            'status' => 'pending',
            'requested_by' => Auth::id(),
        ]);
        return Redirect::route('purchase-requests.index')->with('success', 'Permintaan pembelian berhasil dibuat.');
    }

    public function approve(PurchaseRequest $purchaseRequest)
    {
        if (!Auth::user()->hasRole('purchase')) {
            return abort(Response::HTTP_FORBIDDEN);
        }
        $purchaseRequest->status = 'approved';
        $purchaseRequest->save();
        return Redirect::route('purchase-requests.index')->with('success', 'PR disetujui.');
    }

    public function reject(PurchaseRequest $purchaseRequest)
    {
        if (!Auth::user()->hasRole('purchase')) {
            return abort(Response::HTTP_FORBIDDEN);
        }
        $purchaseRequest->status = 'rejected';
        $purchaseRequest->save();
        return Redirect::route('purchase-requests.index')->with('success', 'PR ditolak.');
    }
}
