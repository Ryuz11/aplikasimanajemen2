<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceiptItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_receipt_id', 'barang_id', 'jumlah_diterima', 'keterangan'
    ];

    public function goodsReceipt()
    {
        return $this->belongsTo(GoodsReceipt::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
