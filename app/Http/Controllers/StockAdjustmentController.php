<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\StockAdjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 'approved');

        $adjustments = StockAdjustment::with(['product', 'user', 'batch', 'approver'])
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('stock_adjustments.index', compact('adjustments', 'status'));
    }

    public function create()
    {
        $products = Product::where('status', 'approved')->orderBy('name')->get();
        return view('stock_adjustments.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_batch_id' => 'nullable|exists:product_batches,id',
            'quantity_diff' => 'required|integer|not_in:0',
            'reason' => 'required|string|max:255',
        ]);

        StockAdjustment::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'product_batch_id' => $validated['product_batch_id'] ?? null,
            'quantity_diff' => $validated['quantity_diff'],
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('stock_adjustments.index', ['status' => 'pending'])
            ->with('success', 'Stock adjustment submitted for supervisor approval.');
    }

    public function approve(StockAdjustment $stockAdjustment)
    {
        if (auth()->user()->role !== 'supervisor') {
            abort(403);
        }

        if ($stockAdjustment->status !== 'pending') {
            return back()->with('error', 'Already processed.');
        }

        DB::transaction(function () use ($stockAdjustment) {
            $product = $stockAdjustment->product;

            // 1. Update Batch (if applicable)
            if ($stockAdjustment->product_batch_id) {
                $batch = $stockAdjustment->batch;
                if ($stockAdjustment->quantity_diff < 0 && ($batch->quantity + $stockAdjustment->quantity_diff < 0)) {
                    throw ValidationException::withMessages(['quantity_diff' => 'Insufficient stock in batch.']);
                }
                $batch->increment('quantity', $stockAdjustment->quantity_diff);
            }

            // 2. Update Product Total
            if ($stockAdjustment->quantity_diff < 0 && ($product->stock + $stockAdjustment->quantity_diff < 0)) {
                throw ValidationException::withMessages(['quantity_diff' => 'Insufficient total stock.']);
            }
            $product->increment('stock', $stockAdjustment->quantity_diff);

            $stockAdjustment->status = 'approved';
            $stockAdjustment->approved_by = auth()->id();
            $stockAdjustment->save();
        });

        return back()->with('success', 'Stock adjustment approved and applied.');
    }

    public function reject(StockAdjustment $stockAdjustment)
    {
        if (auth()->user()->role !== 'supervisor') {
            abort(403);
        }

        $stockAdjustment->update([
            'status' => 'rejected',
            'approved_by' => auth()->id()
        ]);

        return back()->with('success', 'Stock adjustment rejected.');
    }
}
