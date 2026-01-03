<div class="hidden md:flex flex-col w-72 bg-[#1e293b] text-white">
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-24 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <div
                class="w-10 h-10 bg-white rounded-lg flex items-center justify-center overflow-hidden border border-gray-600 shadow-sm">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="max-h-full max-w-full object-contain p-0.5">
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-2xl tracking-wide uppercase leading-tight">WMS</span>
                <span class="text-[10px] text-gray-400 font-bold tracking-widest uppercase">System</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1">

        <!-- Dashboard key -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>

        <div class="mt-8 mb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Master Data</div>

        <!-- Products -->
        <a href="{{ route('products.index') }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->routeIs('products.*') ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Products
        </a>

        <!-- Categories -->
        <a href="{{ route('categories.index') }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->routeIs('categories.*') ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Categories
        </a>

        <!-- Suppliers -->
        <a href="{{ route('suppliers.index') }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->routeIs('suppliers.*') ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Suppliers
        </a>

        <div class="mt-8 mb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Inventory Flow</div>

        <!-- Inbound -->
        <a href="{{ route('transactions.index', ['type' => 'inbound']) }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->input('type') == 'inbound' ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
            Inbound Stock
        </a>

        <!-- Outbound -->
        <a href="{{ route('transactions.index', ['type' => 'outbound']) }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->input('type') == 'outbound' ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
            Outbound Stock
        </a>

        <!-- Stock Adjustments (Opname) -->
        <a href="{{ route('stock_adjustments.index') }}"
            class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->routeIs('stock_adjustments.*') ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Stock Adjustments
        </a>

        @if(auth()->user()->role === 'supervisor')
            <div class="mt-8 mb-2 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Management</div>

            <!-- Reports -->
            <a href="{{ route('reports.index') }}"
                class="flex items-center px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 group {{ request()->routeIs('reports.*') ? 'bg-white text-[#1e293b] shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Reports
            </a>
        @endif
    </div>
</div>