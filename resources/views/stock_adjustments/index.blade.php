<x-app-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">
                Stock Adjustments (Opname)
            </h2>
            <p class="text-sm text-gray-500">
                Manage stock corrections and physical count adjustments.
            </p>
        </div>
        <div>
            <a href="{{ route('stock_adjustments.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Adjustment
            </a>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="mb-6 flex space-x-4 border-b border-gray-200">
        <a href="{{ route('stock_adjustments.index', ['status' => 'approved']) }}"
            class="pb-2 px-1 text-sm font-semibold transition-colors {{ $status === 'approved' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            History (Approved)
        </a>
        <a href="{{ route('stock_adjustments.index', ['status' => 'pending']) }}"
            class="pb-2 px-1 text-sm font-semibold transition-colors {{ $status === 'pending' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            Pending Requests
            @php $pendingCount = \App\Models\StockAdjustment::where('status', 'pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="ml-1 bg-rose-100 text-rose-600 px-2 py-0.5 rounded-full text-[10px]">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="{{ route('stock_adjustments.index', ['status' => 'rejected']) }}"
            class="pb-2 px-1 text-sm font-semibold transition-colors {{ $status === 'rejected' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            Rejected
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Adjustment</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Reason
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status
                        </th>
                        @if(auth()->user()->role === 'supervisor' && $status === 'pending')
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($adjustments as $adj)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $adj->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-0">
                                        <div class="text-sm font-bold text-gray-900">{{ $adj->product->name }}</div>
                                        @if($adj->batch)
                                            <div
                                                class="text-[10px] text-indigo-600 font-mono mt-0.5 bg-indigo-50 px-1 rounded w-fit">
                                                Batch: {{ $adj->batch->batch_number }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $adj->quantity_diff > 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $adj->quantity_diff > 0 ? '+' : '' }}{{ $adj->quantity_diff }}
                                    {{ $adj->product->unit }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $adj->reason }}
                                <div class="text-[10px] text-gray-400">By: {{ $adj->user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span
                                    class="capitalize px-2 py-0.5 rounded-full text-[10px] font-bold 
                                        {{ $adj->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($adj->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                    {{ $adj->status }}
                                </span>
                            </td>
                            @if(auth()->user()->role === 'supervisor' && $adj->status === 'pending')
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <div class="flex justify-end space-x-2">
                                        <form action="{{ route('stock_adjustments.approve', $adj) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-emerald-600 hover:text-emerald-800 font-bold uppercase text-[10px]">Approve</button>
                                        </form>
                                        <form action="{{ route('stock_adjustments.reject', $adj) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-rose-600 hover:text-rose-800 font-bold uppercase text-[10px]">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <p class="text-sm">No {{ $status }} adjustments found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $adjustments->appends(['status' => $status])->links() }}
        </div>
    </div>
</x-app-layout>