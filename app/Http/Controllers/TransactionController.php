<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->input('type', 'inbound');
        $status = $request->input('status', 'approved'); // Default to approved for history

        $transactions = Transaction::with(['product', 'supplier', 'user', 'approver'])
            ->where('type', $type)
            ->when($status, function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions', 'type', 'status'));
    }

    public function create(Request $request)
    {
        $type = $request->input('type', 'inbound');
        $products = \App\Models\Product::where('status', 'approved')->orderBy('name')->get();
        $suppliers = \App\Models\Supplier::all();

        return view('transactions.create', compact('products', 'suppliers', 'type'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:inbound,outbound',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'supplier_id' => 'nullable|required_if:type,inbound|exists:suppliers,id',
            'recipient' => 'nullable|required_if:type,outbound|string|max:255',
            'notes' => 'nullable|string',
            'batch_number' => 'nullable|required_if:type,inbound|string|max:255',
            'product_batch_id' => 'nullable|required_if:type,outbound|exists:product_batches,id',
        ]);

        Transaction::create([
            'user_id' => auth()->id(),
            'type' => $validated['type'],
            'product_id' => $validated['product_id'],
            'product_batch_id' => $validated['product_batch_id'] ?? null,
            'batch_number' => $validated['batch_number'] ?? null,
            'supplier_id' => $validated['supplier_id'] ?? null,
            'quantity' => $validated['quantity'],
            'date' => $validated['date'],
            'recipient' => $validated['recipient'] ?? null,
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        return redirect()->route('transactions.index', ['type' => $validated['type'], 'status' => 'pending'])
            ->with('success', 'Transaction request submitted and awaiting supervisor approval.');
    }

    public function approve(Transaction $transaction)
    {
        if (auth()->user()->role !== 'supervisor') {
            abort(403);
        }

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'This transaction has already been processed.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($transaction) {
            $product = $transaction->product;

            if ($transaction->type === 'inbound') {
                // Inbound: Create or Find Batch
                $batch = \App\Models\ProductBatch::firstOrCreate(
                    ['product_id' => $product->id, 'batch_number' => $transaction->batch_number],
                    ['quantity' => 0, 'received_date' => $transaction->date]
                );

                $batch->increment('quantity', $transaction->quantity);
                $product->increment('stock', $transaction->quantity);

                $transaction->product_batch_id = $batch->id;
            } else {
                // Outbound: Deduct from specific batch
                $batch = $transaction->batch;
                if (!$batch || $batch->quantity < $transaction->quantity) {
                    throw new \Exception("Insufficient stock in batch.");
                }

                $batch->decrement('quantity', $transaction->quantity);
                $product->decrement('stock', $transaction->quantity);
            }

            $transaction->status = 'approved';
            $transaction->approved_by = auth()->id();
            $transaction->save();
        });

        return back()->with('success', 'Transaction approved and inventory updated.');
    }

    public function reject(Transaction $transaction)
    {
        if (auth()->user()->role !== 'supervisor') {
            abort(403);
        }

        $transaction->update([
            'status' => 'rejected',
            'approved_by' => auth()->id()
        ]);

        return back()->with('success', 'Transaction has been rejected.');
    }
}
