<x-app-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">
                {{ $periodLabel }}
            </h2>
            <p class="text-sm text-gray-500">
                Transaction Summary
            </p>
        </div>
        <button onclick="window.print()"
            class="no-print inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            Print Report
        </button>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="text-sm font-medium text-gray-500 uppercase">Total Inbound</div>
            <div class="mt-2 text-3xl font-bold text-emerald-600">+{{ number_format($totalInbound) }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="text-sm font-medium text-gray-500 uppercase">Total Outbound</div>
            <div class="mt-2 text-3xl font-bold text-rose-600">-{{ number_format($totalOutbound) }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="text-sm font-medium text-gray-500 uppercase">Net Movement</div>
            <div class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($totalInbound - $totalOutbound) }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Qty</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Partner</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($transactions as $t)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($t->date)->format('H:i') }}
                        </td>
                        <td class="px-6 py-3">
                            <span
                                class="px-2 py-1 rounded text-xs font-bold uppercase {{ $t->type === 'inbound' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $t->type }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $t->product->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $t->quantity }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">
                            {{ $t->type === 'inbound' ? ($t->supplier->name ?? '-') : ($t->recipient ?? '-') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                background: white;
            }

            .shadow-sm {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</x-app-layout>