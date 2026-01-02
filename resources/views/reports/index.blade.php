<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">
            Reports
        </h2>
        <p class="text-sm text-gray-500">
            Generate insights and track inventory performance.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Transaction Reports -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Transaction History</h3>
            <form action="{{ route('reports.generate') }}" method="GET" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Report Period</label>
                    <select name="period"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="annual">Annual</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <button type="submit"
                    class="w-full justify-center inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Generate Report
                </button>
            </form>
        </div>

        <!-- Inventory Report -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Current Inventory</h3>
            <p class="text-gray-600 text-sm mb-6">
                View real-time stock levels, batch details, and asset valuation.
            </p>
            <a href="{{ route('reports.inventory') }}"
                class="w-full justify-center inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 shadow-sm">
                View Inventory Report
            </a>
        </div>
    </div>
</x-app-layout>