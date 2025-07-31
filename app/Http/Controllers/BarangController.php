<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::paginate(10);
        return View::make('barangs.index', compact('barangs'));
    }

    public function create()
    {
        return View::make('barangs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50|unique:barangs,kode',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
        ]);
        DB::transaction(function () use ($validated) {
            $barang = Barang::create($validated);
            StockTransaction::create([
                'barang_id' => $barang->id,
                'type' => 'in',
                'qty' => $barang->stok,
                'keterangan' => 'Barang baru ditambahkan',
            ]);
        });
        return Redirect::route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return View::make('barangs.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50|unique:barangs,kode,' . $barang->getKey(),
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
        ]);
        DB::transaction(function () use ($validated, $barang) {
            $oldStok = $barang->stok;
            $barang->update($validated);
            $diff = $validated['stok'] - $oldStok;
            if ($diff != 0) {
                StockTransaction::create([
                    'barang_id' => $barang->id,
                    'type' => $diff > 0 ? 'in' : 'out',
                    'qty' => abs($diff),
                    'keterangan' => 'Update stok barang',
                ]);
            }
        });
        return Redirect::route('barangs.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
    {
        DB::transaction(function () use ($barang) {
            StockTransaction::create([
                'barang_id' => $barang->id,
                'type' => 'adjustment',
                'qty' => $barang->stok,
                'keterangan' => 'Barang dihapus, stok diadjust',
            ]);
            $barang->delete();
        });
        return Redirect::route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }
}
