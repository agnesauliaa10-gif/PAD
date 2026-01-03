<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Supplier;
use Carbon\Carbon;

use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::where('status', 'approved')->count();
        $totalSuppliers = Supplier::count();
        $totalCategories = Category::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock')->count();
        $recentTransactions = Transaction::with(['product', 'user'])->where('status', 'approved')->latest()->take(5)->get();

        $inboundThisMonth = Transaction::where('type', 'inbound')
            ->where('status', 'approved')
            ->whereMonth('date', Carbon::now()->month)
            ->sum('quantity');

        $inboundCount = Transaction::where('type', 'inbound')->where('status', 'approved')->count();

        $outboundThisMonth = Transaction::where('type', 'outbound')
            ->where('status', 'approved')
            ->whereMonth('date', Carbon::now()->month)
            ->sum('quantity');

        $outboundCount = Transaction::where('type', 'outbound')->where('status', 'approved')->count();

        $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $pendingApprovals = 0;
        if (auth()->user()->role === 'supervisor') {
            $pendingApprovals = Transaction::where('status', 'pending')->count() +
                \App\Models\StockAdjustment::where('status', 'pending')->count() +
                Product::where('status', 'pending')->count();
        }

        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'totalCategories',
            'lowStockCount',
            'lowStockProducts',
            'recentTransactions',
            'inboundThisMonth',
            'outboundThisMonth',
            'inboundCount',
            'outboundCount',
            'pendingApprovals'
        ));
    }
}
