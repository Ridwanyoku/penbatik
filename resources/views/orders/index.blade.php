<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold">Transactions</h1>
        <p class="text-gray-500 text-sm">Manage and confirm customer payments</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b text-[10px] uppercase tracking-widest text-gray-400">
                    <th class="py-4 px-6">Details</th>
                    <th class="py-4 px-6 text-center">Payment Receipt</th>
                    <th class="py-4 px-6 text-center">Status</th>
                    <th class="py-4 px-6">Id</th>
                    <th class="py-4 px-6">Price</th>
                    <th class="py-4 px-6">Update</th>
                    <th class="py-4 px-6 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($orders as $order)
                <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">
                                {{ substr($order->username, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $order->username }}</p>
                                <p class="text-[10px] text-gray-400 uppercase">Customer</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        @if($order->payment_receipt)
                            <a href="{{ asset('storage/' . $order->payment_receipt) }}" target="_blank" class="inline-block bg-black text-white text-[10px] font-bold px-4 py-1 rounded uppercase tracking-widest hover:bg-gray-800">
                                Show
                            </a>
                        @else
                            <span class="text-gray-300 italic text-xs font-medium">No Receipt</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter 
                            {{ $order->status == 'waiting_confirmation' ? 'bg-blue-50 text-blue-500 border border-blue-100' : 'bg-gray-100 text-gray-400' }}">
                            {{ str_replace('_', ' ', $order->status) }}
                        </span>
                    </td>
                    <td class="py-4 px-6 font-mono text-gray-400">{{ $order->id }}</td>
                    <td class="py-4 px-6 font-bold text-gray-900">
                        {{ number_format($order->total, 0, ',', '.') }}
                    </td>
                    <td class="py-4 px-6">
                        <p class="text-[10px] font-bold text-gray-900">{{ $order->updated_at->format('M d, Y') }}</p>
                        <p class="text-[10px] text-gray-400">{{ $order->updated_at->format('g:i A') }}</p>
                    </td>
                    <td class="py-4 px-6 text-right">
                        @if($order->status == 'waiting_confirmation')
                            <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-[#FF3B30] text-white text-[10px] font-bold px-4 py-2 rounded-lg uppercase tracking-widest hover:shadow-lg transition">
                                    Confirm
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-20 text-center text-gray-400 italic">No transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</x-app-layout>