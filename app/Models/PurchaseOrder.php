<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_request_id',
        'po_number',
        'status',
        'supplier_name',
        'order_date'
    ];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
