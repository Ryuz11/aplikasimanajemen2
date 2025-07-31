<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseReportController;
use App\Models\Barang;
use App\Models\GoodsReceipt;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->hasRole('admin')) {
        return view('admin.dashboard');
    } elseif ($user->hasRole('warehouse')) {
        return app(\App\Http\Controllers\DashboardController::class)->warehouse();
    } elseif ($user->hasRole('purchase')) {
        return app()->make(\App\Http\Controllers\DashboardController::class)->purchase();
    } elseif ($user->hasRole('finance')) {
        return app()->make(\App\Http\Controllers\DashboardController::class)->finance();
    }
    return view('dashboard'); // fallback
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Warehouse Reports Routes
    Route::prefix('warehouse')->name('warehouse.')->middleware(['auth', 'role:warehouse|admin'])->group(function () {
        Route::get('/reports', [WarehouseReportController::class, 'index'])->name('reports');
        Route::post('/reports/generate', [WarehouseReportController::class, 'generateStockReport'])->name('reports.generate');
    });
    Route::resource('users', UserController::class);
    Route::resource('barangs', BarangController::class);
    Route::resource('purchase-requests', \App\Http\Controllers\PurchaseRequestController::class);
    Route::resource('purchase-orders', \App\Http\Controllers\PurchaseOrderController::class);
    Route::resource('goods-receipts', \App\Http\Controllers\GoodsReceiptController::class);
    Route::resource('payments', \App\Http\Controllers\PaymentController::class);
    Route::resource('stock-transactions', \App\Http\Controllers\StockTransactionController::class)->only(['index']);
    Route::post('purchase-orders/{id}/update-status', [\App\Http\Controllers\PurchaseOrderController::class, 'updateStatus'])->name('purchase-orders.update-status');
    Route::post('purchase-requests/{purchaseRequest}/approve', [\App\Http\Controllers\PurchaseRequestController::class, 'approve'])->name('purchase-requests.approve');
    Route::post('payments/{payment}/update-status', [\App\Http\Controllers\PaymentController::class, 'updateStatus'])->name('payments.update-status');
});

require __DIR__.'/auth.php';
