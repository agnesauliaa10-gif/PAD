<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">
            {{ ucfirst($type) }} Logistics
        </h2>
        <p class="text-sm text-gray-500">Record a new {{ $type }} transaction</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-[#f8fafc] border-b border-gray-100">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">New {{ ucfirst($type) }} Entry</h3>
            </div>
            
            <form action="{{ route('transactions.store') }}" method="POST" class="p-6 md:p-8">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Product & Quantity -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-widest border-b pb-2 mb-4">Stock Details</h4>

                        <!-- Product Select -->
                        <div x-data="{ 
                            productId: '{{ old('product_id') }}',
                            batches: [],
                            fetchBatches() {
                                if (!this.productId) { this.batches = []; return; }
                                fetch(`/products/${this.productId}/batches`)
                                    .then(res => res.json())
                                    .then(data => { this.batches = data.batches; });
                            }
                        }" x-init="fetchBatches()">
                            
                            <x-input-label for="product_id" :value="__('Select Product')" class="text-xs font-bold text-gray-700 uppercase" />
                            <select id="product_id" name="product_id" x-model="productId" @change="fetchBatches()"
                                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">Choose a product...</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }} (SKU: {{ $product->sku }}) - Cur. Stock: {{ $product->stock }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-1" />

                            <!-- Batch Handling -->
                            <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                @if($type === 'inbound')
                                    <!-- Inbound: Create New Batch -->
                                    <x-input-label for="batch_number" :value="__('Batch Number')" class="text-xs font-bold text-gray-700 uppercase" />
                                    <x-text-input id="batch_number" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 shadow-sm sm:text-sm" 
                                        type="text" name="batch_number" :value="old('batch_number')" required placeholder="e.g. BATCH-2023-X" />
                                    <p class="text-xs text-gray-500 mt-1">Assign a batch number for tracking.</p>
                                @else
                                    <!-- Outbound: Select Existing Batch -->
                                    <x-input-label for="product_batch_id" :value="__('Select Batch')" class="text-xs font-bold text-gray-700 uppercase" />
                                    <select id="product_batch_id" name="product_batch_id"
                                        class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">-- Select Batch to Deduct From --</option>
                                        <template x-for="batch in batches" :key="batch.id">
                                            <option :value="batch.id" x-text="`${batch.batch_number} (Qty: ${batch.quantity})`"></option>
                                        </template>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1" x-show="batches.length === 0 && productId">No Available Batches for this product.</p>
                                @endif
                                <x-input-error :messages="$errors->get('batch_number')" class="mt-1" />
                                <x-input-error :messages="$errors->get('product_batch_id')" class="mt-1" />
                            </div>
                        </div>

                        <!-- Quantity -->
                         <div>
                            <x-input-label for="quantity" :value="__('Quantity')" class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="quantity" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors" 
                                type="number" name="quantity" :value="old('quantity')" min="1" required placeholder="Enter amount" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
                        </div>

                        <!-- Date -->
                        <div>
                            <x-input-label for="date" :value="__('Transaction Date')" class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="date" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors" 
                                type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                             <x-input-error :messages="$errors->get('date')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Right Column: Source/Dest & Notes -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-widest border-b pb-2 mb-4">Logistics Info</h4>

                        @if($type === 'inbound')
                            <!-- Supplier (Inbound Only) -->
                            <div>
                                <x-input-label for="supplier_id" :value="__('Supplier')" class="text-xs font-bold text-gray-700 uppercase" />
                                <select id="supplier_id" name="supplier_id"
                                    class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    <option value="">Select Supplier...</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('supplier_id')" class="mt-1" />
                            </div>
                        @else
                            <!-- Recipient (Outbound Only) -->
                             <div>
                                <x-input-label for="recipient" :value="__('Recipient / Destination')" class="text-xs font-bold text-gray-700 uppercase" />
                                <x-text-input id="recipient" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors" 
                                    type="text" name="recipient" :value="old('recipient')" required placeholder="e.g. Hospital Wing A, Client X" />
                                <x-input-error :messages="$errors->get('recipient')" class="mt-1" />
                            </div>
                        @endif

                        <!-- Notes -->
                        <div>
                            <x-input-label for="notes" :value="__('Notes (Optional)')" class="text-xs font-bold text-gray-700 uppercase" />
                            <textarea id="notes" name="notes" rows="4"
                                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Any additional details...">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-4">
                    <a href="{{ route('transactions.index', ['type' => $type]) }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">{{ __('Cancel') }}</a>
                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 px-6 py-2.5 rounded-lg shadow-sm font-semibold text-white uppercase tracking-widest transition-all">
                        {{ __('Record Transaction') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
