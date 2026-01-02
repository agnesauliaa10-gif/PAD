<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">
                Inventory Report
            </h2>
            <p class="text-sm text-gray-500">
                Real-time stock levels by product and batch.
            </p>
        </div>
        <button onclick="window.print()"
            class="no-print inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            Print
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Total Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Active Batches</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($products as $product)
                    <tr class="{{ $product->stock <= $product->min_stock ? 'bg-red-50' : '' }}">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs text-gray-500">{{ $product->sku }}</div>
                            @if($product->stock <= $product->min_stock)
                                <div class="text-xs text-red-600 font-bold mt-1">LOW STOCK ALERT</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $product->category->name }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="text-sm font-bold {{ $product->stock <= $product->min_stock ? 'text-red-700' : 'text-gray-900' }}">
                                {{ $product->stock }} {{ $product->unit }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @if($product->batches->count() > 0)
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($product->batches as $batch)
                                        <li>
                                            <span
                                                class="font-mono text-xs bg-gray-100 px-1 rounded">{{ $batch->batch_number }}</span>:
                                            {{ $batch->quantity }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-400 italic">No active batches</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>