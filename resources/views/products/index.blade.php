<x-app-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">Product Management</h2>
            <p class="text-sm text-gray-500">View and manage your product catalogue</p>
        </div>
        @if(auth()->user()->role === 'supervisor')
            <div>
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Product
                </a>
            </div>
        @endif
    </div>

    <!-- Stats Row (Optional, adding quick stats for products page specifically) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase">Total Items</p>
                <p class="text-xl font-bold text-gray-800">{{ $products->total() }}</p>
            </div>
            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ deleteUrl: '' }">
        <!-- Toolbar -->
        <div
            class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#f8fafc]">
            <div class="flex items-center space-x-2">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">Product List</h3>
            </div>
            <div class="relative max-w-sm w-full">
                <input type="text" placeholder="Search by name, SKU..."
                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm" />
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product
                            Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">SKU /
                            Ref</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Category / Type</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stock
                            Level</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Price/Unit</th> <!-- Added placeholder for price if needed, or unit -->
                        @if(auth()->user()->role === 'supervisor')
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Manage
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50 transition duration-150 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                        <img class="h-10 w-10 object-cover"
                                            src="{{ $product->image ? asset('storage/' . $product->image) : 'https://ui-avatars.com/api/?name=' . urlencode($product->name) . '&background=random' }}"
                                            alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-[150px]">
                                            {{ $product->description ?? 'No description' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600 font-mono">
                                {{ $product->sku }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="w-fit px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>
                                    <span class="text-[10px] text-gray-500 uppercase tracking-tight font-semibold">
                                        {{ str_replace('_', ' ', $product->type ?? '-') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span
                                        class="text-sm font-bold {{ $product->stock <= $product->min_stock ? 'text-rose-600' : 'text-emerald-600' }}">
                                        {{ $product->stock }} {{ $product->unit }}
                                    </span>
                                    @if($product->stock <= $product->min_stock)
                                        <span class="text-[10px] text-rose-500 font-medium">Below Min:
                                            {{ $product->min_stock }}</span>
                                    @else
                                        <span class="text-[10px] text-gray-400">Min: {{ $product->min_stock }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                - <!-- Placeholder for Price if we add it later -->
                            </td>
                            @if(auth()->user()->role === 'supervisor')
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div
                                        class="flex items-center justify-end space-x-2 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="p-1.5 bg-white border border-gray-200 rounded-md text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition-colors shadow-sm"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <button
                                            x-on:click="$dispatch('open-modal', 'confirm-product-deletion'); deleteUrl = '{{ route('products.destroy', $product) }}'"
                                            class="p-1.5 bg-white border border-gray-200 rounded-md text-rose-600 hover:bg-rose-50 hover:border-rose-300 transition-colors shadow-sm"
                                            title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 rounded-full p-4 mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <p class="text-base font-medium text-gray-900">No products found</p>
                                    <p class="text-sm text-gray-500 mb-4">Your store is empty. Start adding items.</p>
                                    <a href="{{ route('products.create') }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">Add First Product
                                        &rarr;</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $products->links() }}
        </div>

        <!-- Delete Confirmation Modal (Reused) -->
        <x-modal name="confirm-product-deletion" focusable>
            <form method="post" :action="deleteUrl" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Delete Product?') }}
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('This action cannot be undone. All data associated with this product will be permanently removed.') }}
                </p>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-rose-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                        {{ __('Delete Product') }}
                    </button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>