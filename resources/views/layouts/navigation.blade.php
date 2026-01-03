<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 h-20 flex items-center shadow-sm z-30 relative">
    <div class="px-4 sm:px-6 lg:px-8 w-full"> <!-- Changed max-w-7xl mx-auto to w-full -->
        <div class="flex justify-between items-center h-full">

            <!-- Left: Hamburger & Search -->
            <div class="flex-1 flex items-center">
                <!-- Hamburger (Mobile) -->
                <div class="-ml-2 mr-4 flex items-center md:hidden">
                    <button @click="sidebarOpen = true"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Search -->
                <div class="relative w-full max-w-xl">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-100 rounded-lg leading-5 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Search product, supplier, order...">
                </div>
            </div>

            <!-- Right: Actions & Profile -->
            <div class="flex items-center space-x-6 ml-4">

                <!-- Quick Date/Help (Optional from ref, skipping for clean look) -->

                <!-- Notification / Approvals -->
                @if(auth()->user()->role === 'supervisor')
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none transition-colors">
                            @if($pendingApprovalsCount > 0)
                                <span
                                    class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[10px] text-white font-bold ring-2 ring-white">
                                    {{ $pendingApprovalsCount }}
                                </span>
                            @endif
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-72 rounded-xl shadow-xl py-2 bg-white ring-1 ring-black ring-opacity-5 z-50 border border-gray-100">

                            <div class="px-4 py-2 border-b border-gray-50 bg-gray-50/50">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Pending Approvals</h3>
                            </div>

                            <div class="divide-y divide-gray-50">
                                @php 
                                                                $pendingTransactions = \App\Models\Transaction::where('status', 'pending')->count();
                                    $pendingAdjustments = \App\Models\StockAdjustment::where('status', 'pending')->count();
                                    $pendingProducts = \App\Models\Product::where('status', 'pending')->count();
                                @endphp





                                <a href="{{ route('transactions.index', ['status' => 'pending']) }}" class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-indigo-50 rounded-lg mr-3 text-indigo-600">

                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Transactions</span>
                                    </div>

                                                                   <span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingTransactions }}</span>
                                </a>





                                                                            <a href="{{ route('stock_adjustments.index', ['status' => 'pending']) }}" class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-amber-50 rounded-lg mr-3 text-amber-600">

                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Stock Adjustments</span>
                                    </div>

                                                                   <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingAdjustments }}</span>
                                </a>





                                                                        <a href="{{ route('products.index', ['status' => 'pending']) }}" class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-blue-50 rounded-lg mr-3 text-blue-600">

                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">New Products</span>
                                    </div>
                                    <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingProducts }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <button class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                @endif

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center space-x-3 text-sm focus:outline-none transition duration-150 ease-in-out">
                        <div class="flex flex-col items-end hidden md:flex">
                            <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</span>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center border-2 border-indigo-200 text-indigo-700 font-bold text-lg overflow-hidden">
                            <!-- Placeholder Avatar or Initials -->
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden absolute top-20 left-0 w-full bg-white shadow-lg border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <!-- Add other responsive links if needed, usually sidebar handles this on mobile via distinct layout but simplified here -->
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>