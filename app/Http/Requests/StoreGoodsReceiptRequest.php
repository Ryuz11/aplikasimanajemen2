<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreGoodsReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->hasRole('warehouse');
    }

    public function rules()
    {
        return [
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'tanggal' => 'required|date',
            'kondisi' => 'nullable|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'items' => 'required|array',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah_diterima' => 'required|integer|min:1',
            'items.*.keterangan' => 'nullable|string',
        ];
    }
}
