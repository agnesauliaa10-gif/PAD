<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\StockAdjustment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate(Request $request)
    {
        $type = $request->input('period', 'daily'); // daily, weekly, monthly, annual
        $date = $request->input('date', now()->format('Y-m-d'));

        $query = Transaction::with(['product', 'user', 'supplier'])
            ->latest();

        $carbonDate = Carbon::parse($date);
        $periodLabel = "";

        switch ($type) {
            case 'daily':
                $query->whereDate('date', $carbonDate->format('Y-m-d'));
                $periodLabel = "Daily Report: " . $carbonDate->format('d M Y');
                break;
            case 'weekly':
                $start = $carbonDate->copy()->startOfWeek();
                $end = $carbonDate->copy()->endOfWeek();
                $query->whereBetween('date', [$start, $end]);
                $periodLabel = "Weekly Report: " . $start->format('d M') . " - " . $end->format('d M Y');
                break;
            case 'monthly':
                $query->whereYear('date', $carbonDate->year)
                    ->whereMonth('date', $carbonDate->month);
                $periodLabel = "Monthly Report: " . $carbonDate->format('F Y');
                break;
            case 'annual':
                $query->whereYear('date', $carbonDate->year);
                $periodLabel = "Annual Report: " . $carbonDate->format('Y');
                break;
        }

        $transactions = $query->get();

        // Calculate summaries
        $totalInbound = $transactions->where('type', 'inbound')->sum('quantity');
        $totalOutbound = $transactions->where('type', 'outbound')->sum('quantity');

        // Get adjustments for this period as well? 
        // Typically reports focus on transactions (movement), but adjustments are also movement.
        // Let's stick to Transaction Reports for now as per "Laporan berkala (harian...)" usually implies flow.
        // But we can include a section for adjustments if needed.

        return view('reports.show', compact('transactions', 'periodLabel', 'totalInbound', 'totalOutbound', 'type', 'date'));
    }

    public function inventory()
    {
        $products = Product::with([
            'category',
            'batches' => function ($q) {
                $q->where('quantity', '>', 0);
            }
        ])->get();

        return view('reports.inventory', compact('products'));
    }
}
