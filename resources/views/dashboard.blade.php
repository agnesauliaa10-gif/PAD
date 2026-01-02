<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">Dashboard</h2>
    </div>

    <!-- Row 1: Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Products -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-[#1e293b] mb-1">{{ $totalProducts }}</h3>
                <p class="text-sm font-medium text-gray-500">Total Products</p>
            </div>
            <div class="p-3 bg-indigo-50 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-[#1e293b] mb-1">{{ $totalCategories }}</h3>
                <p class="text-sm font-medium text-gray-500">Total Categories</p>
            </div>
            <div class="p-3 bg-blue-50 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-[#1e293b] mb-1 text-red-600">{{ $lowStockCount }}</h3>
                <p class="text-sm font-medium text-gray-500">Low Stock Alerts</p>
            </div>
            <div class="p-3 bg-red-50 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>

        <!-- Total Suppliers -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-[#1e293b] mb-1">{{ $totalSuppliers }}</h3>
                <p class="text-sm font-medium text-gray-500">Total Suppliers</p>
            </div>
            <div class="p-3 bg-orange-50 rounded-lg">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>

        <!-- Pending Approvals (Supervisor Only) -->
        @if(auth()->user()->role === 'supervisor')
            <a href="{{ route('transactions.index', ['status' => 'pending']) }}"
                class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between hover:bg-amber-50 transition-colors">
                <div>
                    <h3 class="text-3xl font-bold text-amber-600 mb-1">{{ $pendingApprovals }}</h3>
                    <p class="text-sm font-medium text-gray-500">Pending Approvals</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </a>
        @endif
    </div>

    <!-- Row 2: Transaction Summaries -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Inbound Count -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-emerald-600 mb-1">+{{ $inboundCount }}</h3>
                <p class="text-sm font-medium text-gray-500">Inbound Orders</p>
            </div>
            <div class="p-3 bg-emerald-50 rounded-lg">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                </svg>
            </div>
        </div>

        <!-- Inbound Quantity -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $inboundThisMonth }}</h3>
                <p class="text-sm font-medium text-gray-500">Inbound Qty (Month)</p>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600 font-bold text-lg">Unit</span>
            </div>
        </div>

        <!-- Outbound Count -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-rose-600 mb-1">-{{ $outboundCount }}</h3>
                <p class="text-sm font-medium text-gray-500">Outbound Orders</p>
            </div>
            <div class="p-3 bg-rose-50 rounded-lg">
                <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
                </svg>
            </div>
        </div>

        <!-- Outbound Quantity -->
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-start justify-between">
            <div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $outboundThisMonth }}</h3>
                <p class="text-sm font-medium text-gray-500">Outbound Qty (Month)</p>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600 font-bold text-lg">Unit</span>
            </div>
        </div>
    </div>

    <!-- Row 3: Low Stock Alerts & Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Low Stock Alerts -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-[#fff1f2]">
                <h3 class="font-bold text-rose-700 uppercase tracking-wider text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Low Stock Alerts
                </h3>
            </div>
            <div class="flex-1">
                <ul class="divide-y divide-gray-100">
                    @forelse($lowStockProducts as $product)
                        <li class="px-6 py-4 hover:bg-rose-50 transition-colors duration-150">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-rose-600">{{ $product->stock }} {{ $product->unit }}
                                    </p>
                                    <p class="text-[10px] text-gray-400 font-medium uppercase">Min:
                                        {{ $product->min_stock }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="h-8 w-8 text-emerald-300 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs">All stocks are above minimum.</span>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
            @if ($lowStockCount > 5)
                <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 italic text-[10px] text-gray-400 text-center">
                    Showing 5 of {{ $lowStockCount }} items
                </div>
            @endif
        </div>

        <!-- Recent Transactions Table -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-[#f8fafc]">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">Recent Transactions</h3>
                <a href="{{ route('transactions.index') }}"
                    class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 uppercase tracking-wide">View
                    All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="bg-[#f1f5f9]">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Type</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Product</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Qty</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                User</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($recentTransactions as $transaction)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                    {{ $transaction->date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $transaction->type === 'inbound' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#1e293b] font-semibold">
                                    {{ $transaction->product->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-bold">
                                    {{ $transaction->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $transaction->user->name }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="h-10 w-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="text-sm">No recent transactions recorded.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>