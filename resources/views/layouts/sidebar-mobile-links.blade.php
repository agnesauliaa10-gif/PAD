<!-- Dashboard -->
<a href="{{ route('dashboard') }}"
    class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <svg class="mr-4 h-6 w-6 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
    </svg>
    Dashboard
</a>

<!-- Products -->
<a href="{{ route('products.index') }}"
    class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('products.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <svg class="mr-4 h-6 w-6 flex-shrink-0 {{ request()->routeIs('products.*') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
    </svg>
    Products
</a>

<!-- Categories -->
<a href="{{ route('categories.index') }}"
    class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('categories.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <svg class="mr-4 h-6 w-6 flex-shrink-0 {{ request()->routeIs('categories.*') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
    </svg>
    Categories
</a>

<!-- Suppliers -->
<a href="{{ route('suppliers.index') }}"
    class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('suppliers.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <svg class="mr-4 h-6 w-6 flex-shrink-0 {{ request()->routeIs('suppliers.*') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    Suppliers
</a>

<!-- Inbound -->
<a href="{{ route('transactions.index', ['type' => 'inbound']) }}"
    class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->input('type') == 'inbound' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <svg class="mr-4 h-6 w-6 flex-shrink-0 {{ request()->input('type') == 'inbound' ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
    </svg>
    Inbound
</a>

<!-- Outbound -->
<a href="{{ route('transactions.index', ['type' => 'outbound']) }}"
    class="mt-1 group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->input('type') == 'outbound' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <svg class="mr-4 h-6 w-6 flex-shrink-0 {{ request()->input('type') == 'outbound' ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
    </svg>
    Outbound
</a>