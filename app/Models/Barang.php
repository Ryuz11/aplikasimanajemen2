<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'stok',
        'stok_minimum',
    ];

    public static function allBarang()
    {
        return self::query()->get();
    }

    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }
}
