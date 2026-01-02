<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">
                New Stock Adjustment
            </h2>
            <p class="text-sm text-gray-500">
                Record a stock opname result or manual correction.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('stock_adjustments.store') }}" method="POST">
                @csrf

                <!-- Product -->
                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                    <select name="product_id" id="product_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        onchange="loadBatches(this.value)">
                        <option value="">Select a product...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Batch (Dynamic) -->
                <div class="mb-4">
                    <label for="product_batch_id" class="block text-sm font-medium text-gray-700">Batch
                        (Optional)</label>
                    <select name="product_batch_id" id="product_batch_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">No Batch / General Stock</option>
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Select if adjusting specific batch stock.</p>
                </div>

                <!-- Quantity Difference -->
                <div class="mb-4">
                    <label for="quantity_diff" class="block text-sm font-medium text-gray-700">Quantity
                        Adjustment</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" name="quantity_diff" id="quantity_diff" required
                            class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="-5 or 10">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Use negative values to remove stock, positive to add.</p>
                    @error('quantity_diff') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Reason -->
                <div class="mb-6">
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                    <input type="text" name="reason" id="reason" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="e.g., Stock Opname, Damaged Goods, Found Stock">
                    @error('reason') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('stock_adjustments.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 rounded-lg text-sm font-medium text-white hover:bg-indigo-700">
                        Save Adjustment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function loadBatches(productId) {
            const batchSelect = document.getElementById('product_batch_id');
            batchSelect.innerHTML = '<option value="">Loading...</option>';

            if (!productId) {
                batchSelect.innerHTML = '<option value="">No Batch / General Stock</option>';
                return;
            }

            fetch(`/products/${productId}/batches`)
                .then(response => response.json())
                .then(data => {
                    batchSelect.innerHTML = '<option value="">No Batch / General Stock</option>';
                    if (data.batches) {
                        data.batches.forEach(batch => {
                            const option = document.createElement('option');
                            option.value = batch.id;
                            option.text = `Batch: ${batch.batch_number} (Qty: ${batch.quantity})`;
                            batchSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    batchSelect.innerHTML = '<option value="">Error loading batches</option>';
                });
        }
    </script>
</x-app-layout>