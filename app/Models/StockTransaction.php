<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id', 'type', 'qty', 'keterangan'
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
