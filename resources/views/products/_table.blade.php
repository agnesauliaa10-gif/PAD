<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-100">
        <thead>
            <tr class="bg-gray-50/50">
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product Name</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">SKU / Ref</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Category / Type</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stock Level</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Location</th>
                @if(auth()->user()->role === 'supervisor')
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                        {{ ($status ?? 'approved') === 'pending' ? 'Decision' : 'Manage' }}
                    </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse ($products as $product)
                <tr class="hover:bg-gray-50 transition duration-150 group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
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
                            <span class="w-fit px-2.5 py-0.5 inline-flex text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $product->category->name ?? 'N/A' }}
                            </span>
                            <span class="text-[10px] text-gray-500 uppercase tracking-tight font-semibold">
                                {{ str_replace('_', ' ', $product->type ?? '-') }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold {{ $product->stock <= $product->min_stock ? 'text-rose-600' : 'text-emerald-600' }}">
                                {{ $product->stock }} {{ $product->unit }}
                            </span>
                            @if($product->stock <= $product->min_stock)
                                <span class="text-[10px] text-rose-500 font-medium">Below Min: {{ $product->min_stock }}</span>
                            @else
                                <span class="text-[10px] text-gray-400">Min: {{ $product->min_stock }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $product->location ?? '-' }}
                    </td>
                    @if(auth()->user()->role === 'supervisor')
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                @if($product->status === 'pending')
                                    <form action="{{ route('products.approve', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 bg-emerald-50 border border-emerald-200 rounded-md text-emerald-600 hover:bg-emerald-100 transition-colors shadow-sm" title="Approve">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('products.reject', $product) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 bg-rose-50 border border-rose-200 rounded-md text-rose-600 hover:bg-rose-100 transition-colors shadow-sm" title="Reject">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center justify-end space-x-2 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('products.edit', $product) }}" class="p-1.5 bg-white border border-gray-200 rounded-md text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition-colors shadow-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <button x-on:click="$dispatch('open-modal', 'confirm-product-deletion'); deleteUrl = '{{ route('products.destroy', $product) }}'"
                                            class="p-1.5 bg-white border border-gray-200 rounded-md text-rose-600 hover:bg-rose-50 hover:border-rose-300 transition-colors shadow-sm" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="bg-gray-100 rounded-full p-4 mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <p class="text-base font-medium text-gray-900">No products found</p>
                            <p class="text-sm text-gray-500 mb-4">Your store is empty. Start adding items.</p>
                            <a href="{{ route('products.create') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Add First Product &rarr;</a>
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
