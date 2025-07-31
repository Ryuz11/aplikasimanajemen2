<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'goods_receipt_id',
        'invoice_number',
        'tanggal',
        'jumlah',
        'bukti',
        'status',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function goodsReceipt()
    {
        return $this->belongsTo(GoodsReceipt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
}
