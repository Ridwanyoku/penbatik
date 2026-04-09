<x-app-layout>
    <div class="p-8 bg-white min-h-screen">
        <div class="mb-10">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Transactions</h1>
            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest font-medium">Manage and confirm customer payments</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-50 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                        <th class="px-6 py-5 font-semibold">Customer Details</th>
                        <th class="px-4 py-5 font-semibold">Shipping Address</th>
                        <th class="px-4 py-5 font-semibold text-center text-blue-500">Payment Receipt</th>
                        <th class="px-4 py-5 font-semibold text-center">Status</th>
                        <th class="px-4 py-5 font-semibold text-center text-gray-800">Total Price</th>
                        <th class="px-4 py-5 font-semibold text-center">Date Update</th>
                        <th class="px-6 py-5 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            {{-- 1. Customer Details --}}
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-400 border border-gray-200 uppercase">
                                        {{ substr($order->user->name ?? $order->username, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[12px] font-bold text-gray-900 leading-none mb-1">
                                            {{ $order->user->name ?? $order->username }}
                                        </div>
                                        <div class="text-[9px] text-gray-400 font-mono italic">
                                            ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- 2. Shipping Address --}}
                            <td class="px-4 py-6">
                                <p class="text-[10px] text-gray-500 leading-relaxed uppercase tracking-tighter max-w-[200px] line-clamp-2">
                                    {{ $order->address }}
                                </p>
                            </td>

                            {{-- 3. Payment Receipt --}}
                            <td class="px-4 py-6 text-center">
                                @if($order->payment_receipt)
                                    <a href="{{ asset('storage/' . $order->payment_receipt) }}" target="_blank" 
                                       class="inline-block bg-black text-white text-[9px] font-bold px-4 py-2 rounded uppercase tracking-widest hover:bg-gray-800 transition shadow-sm">
                                        Show Receipt
                                    </a>
                                @else
                                    <span class="text-[10px] text-gray-300 italic font-medium">No Upload</span>
                                @endif
                            </td>

                            {{-- 4. Status --}}
                            <td class="px-4 py-6 text-center">
                                @php
                                    $statusColor = match($order->status) {
                                        'Paying', 'waiting_confirmation' => 'text-blue-500 bg-blue-50 border-blue-100',
                                        'Shipping' => 'text-green-500 bg-green-50 border-green-100',
                                        'Completed' => 'text-gray-900 bg-gray-100 border-gray-200',
                                        default => 'text-gray-400 bg-gray-50 border-gray-100'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase border {{ $statusColor }}">
                                    {{ str_replace('_', ' ', $order->status) }}
                                </span>
                            </td>

                            {{-- 5. Total Price --}}
                            <td class="px-4 py-6 text-center">
                                <span class="text-[12px] font-bold text-gray-800">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- 6. Date Update --}}
                            <td class="px-4 py-6 text-center">
                                <div class="text-[10px] font-bold text-gray-800">{{ $order->updated_at->format('M d, Y') }}</div>
                                <div class="text-[9px] text-gray-300 font-medium uppercase tracking-tighter">{{ $order->updated_at->format('g:i A') }}</div>
                            </td>

                            {{-- 7. Action --}}
                            <td class="px-6 py-6 text-right">
                                @if($order->status === 'Paying' || $order->status === 'waiting_confirmation')
                                    <form action="{{ route('admin.transactions.confirm', $order->id) }}" method="POST" class="flex flex-col items-end gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" name="shipping_receipt" placeholder="ENTER RECEIPT NO." required 
                                            class="text-[9px] border-gray-200 rounded px-3 py-2 focus:ring-1 focus:ring-[#FF3B3B] focus:border-[#FF3B3B] w-40 outline-none placeholder:text-gray-300 font-bold tracking-widest uppercase">
                                        <button type="submit" class="bg-[#FF3B3B] text-white px-6 py-2 rounded text-[9px] font-bold uppercase tracking-[0.2em] hover:bg-red-600 transition shadow-md active:scale-95">
                                            Confirm & Ship
                                        </button>
                                    </form>
                                @else
                                    <div class="flex flex-col items-end">
                                        <span class="text-[9px] font-bold text-gray-300 uppercase tracking-widest px-4 py-2 border border-gray-100 rounded bg-gray-50/50 cursor-not-allowed">
                                            Completed
                                        </span>
                                        @if($order->shipping_receipt)
                                            <div class="mt-2 text-[10px] font-mono text-gray-400 bg-gray-50 px-2 py-1 rounded border border-gray-100">
                                                RESI: {{ $order->shipping_receipt }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-100 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-gray-400 text-xs font-medium uppercase tracking-widest">No transactions recorded.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="mt-8 flex justify-between items-center text-[10px] text-gray-400 font-bold tracking-[0.1em] border-t border-gray-50 pt-8">
                <div>
                    SHOWING <span class="text-gray-900">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span> OF {{ $orders->total() }} RESULTS
                </div>
                <div class="flex items-center gap-4">
                    {{ $orders->links('pagination::simple-tailwind') }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>