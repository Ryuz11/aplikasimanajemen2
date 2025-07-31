<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransaction;
use View;

class StockTransactionController extends Controller
{
    // ...existing methods...

    public function index()
    {
        $transactions = \App\Models\StockTransaction::with('barang')->orderByDesc('created_at')->paginate(15);
        return View::make('stock_transactions.index', compact('transactions'));
    }

    // ...existing methods...
}