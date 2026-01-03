<x-app-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">Inventory Management</h2>
            <p class="text-sm text-gray-500">View and manage your product catalogue</p>
        </div>
        <div>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Product
            </a>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="mb-6 flex space-x-4 border-b border-gray-100" id="statusTabs">
        <a href="{{ route('products.index', ['status' => 'approved']) }}" data-status="approved"
            class="status-tab pb-4 px-2 text-sm font-bold uppercase tracking-wider transition-colors {{ $status === 'approved' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-400 hover:text-gray-600' }}">
            Approved
        </a>
        <a href="{{ route('products.index', ['status' => 'pending']) }}" data-status="pending"
            class="status-tab pb-4 px-2 text-sm font-bold uppercase tracking-wider transition-colors relative {{ $status === 'pending' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-400 hover:text-gray-600' }}">
            Pending
            @php $pendingCount = \App\Models\Product::where('status', 'pending')->count(); @endphp
            @if($pendingCount > 0)
                <span
                    class="absolute -top-1 -right-4 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[10px] text-white">
                    {{ $pendingCount }}
                </span>
            @endif
        </a>
        <a href="{{ route('products.index', ['status' => 'rejected']) }}" data-status="rejected"
            class="status-tab pb-4 px-2 text-sm font-bold uppercase tracking-wider transition-colors {{ $status === 'rejected' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-400 hover:text-gray-600' }}">
            Rejected
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ deleteUrl: '' }">
        <!-- Toolbar -->
        <div
            class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#f8fafc]">
            <div class="flex items-center space-x-2">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">Product List</h3>
            </div>
            <div class="relative max-w-sm w-full">
                <form action="{{ route('products.index') }}" method="GET" id="searchForm">
                    <input type="hidden" name="status" id="statusInput" value="{{ $status }}">
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        placeholder="Search by name, SKU..."
                        class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>

            <script>
                const searchInput = document.getElementById('searchInput');
                const productTableContainer = document.getElementById('productTableContainer');
                const searchForm = document.getElementById('searchForm');

                function fetchProducts(url) {
                    const formData = new FormData(searchForm);
                    const params = new URLSearchParams(formData);

                    // Maintain current URL for history if needed, but for now just fetch
                    fetch(url + (url.includes('?') ? '&' : '?') + params.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            productTableContainer.innerHTML = html;
                        })
                        .catch(error => console.error('Error fetching products:', error));
                }

                searchInput.addEventListener('input', function () {
                    clearTimeout(window.searchTimer);
                    window.searchTimer = setTimeout(() => {
                        fetchProducts("{{ route('products.index') }}");
                    }, 300);
                });

                // Handle AJAX pagination
                productTableContainer.addEventListener('click', function (e) {
                    if (e.target.closest('.pagination a')) {
                        e.preventDefault();
                        const url = e.target.closest('a').href;
                        fetchProducts(url);
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });
                // Handle AJAX status tabs
                document.getElementById('statusTabs').addEventListener('click', function(e) {
                    if (e.target.closest('.status-tab')) {
                        e.preventDefault();
                        const tab = e.target.closest('.status-tab');
                        const status = tab.dataset.status;
                        
                        // Update UI
                        document.querySelectorAll('.status-tab').forEach(t => {
                            t.classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-600');
                            t.classList.add('text-gray-400', 'hover:text-gray-600');
                        });
                        tab.classList.add('text-indigo-600', 'border-b-2', 'border-indigo-600');
                        tab.classList.remove('text-gray-400', 'hover:text-gray-600');

                        // Update hidden input and fetch
                        document.getElementById('statusInput').value = status;
                        fetchProducts("{{ route('products.index') }}");
                    }
                });
            </script>
        </div>

        <div id="productTableContainer">
            @include('products._table')
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