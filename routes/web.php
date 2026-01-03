<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products/{product}/batches', [ProductController::class, 'getBatches'])->name('products.batches');

    // Supervisor-only management & reports
    Route::middleware('role:supervisor')->group(function () {
        Route::post('/products/{product}/approve', [ProductController::class, 'approve'])->name('products.approve');
        Route::post('/products/{product}/reject', [ProductController::class, 'reject'])->name('products.reject');

        Route::resource('products', ProductController::class)->only(['edit', 'update', 'destroy']);
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
        Route::resource('suppliers', SupplierController::class)->except(['index', 'show']);

        Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/generate', [\App\Http\Controllers\ReportController::class, 'generate'])->name('reports.generate');
        Route::get('/reports/inventory', [\App\Http\Controllers\ReportController::class, 'inventory'])->name('reports.inventory');
    });

    // General resources (everyone can view/create)
    Route::resource('products', ProductController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'show']);

    // Flow transactions (both roles)
    Route::post('/transactions/{transaction}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('/transactions/{transaction}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');
    Route::resource('transactions', TransactionController::class);

    Route::post('/stock_adjustments/{stock_adjustment}/approve', [\App\Http\Controllers\StockAdjustmentController::class, 'approve'])->name('stock_adjustments.approve');
    Route::post('/stock_adjustments/{stock_adjustment}/reject', [\App\Http\Controllers\StockAdjustmentController::class, 'reject'])->name('stock_adjustments.reject');
    Route::resource('stock_adjustments', \App\Http\Controllers\StockAdjustmentController::class)->only(['index', 'create', 'store']);
});

require __DIR__ . '/auth.php';
