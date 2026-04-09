<x-app-layout>
    <div class="p-4 sm:p-8 bg-white min-h-screen">
        <div class="mb-10">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Transactions</h1>
            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest font-medium">Manage and confirm customer payments</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Tambahkan overflow-x-auto untuk scroll horizontal di mobile --}}
            <div class="overflow-x-auto scrollbar-hide">
                <table class="w-full text-left border-collapse min-w-[1000px]"> {{-- Set min-width agar tidak berdesakan --}}
                    <thead>
                        <tr class="border-b border-gray-50 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                            {{-- Sticky Column untuk Desktop --}}
                            <th class="px-6 py-5 font-semibold sticky left-0 bg-white z-10 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">Customer Details</th>
                            <th class="px-4 py-5 font-semibold">Shipping Address</th>
                            <th class="px-4 py-5 font-semibold text-center text-blue-500">Payment Receipt</th>
                            <th class="px-4 py-5 font-semibold text-center">Status</th>
                            <th class="px-4 py-5 font-semibold text-center text-gray-800">Total Price</th>
                            <th class="px-4 py-5 font-semibold text-center">Date Update</th>
                            <th class="px-6 py-5 font-semibold text-right uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($orders as $order)
                            <tr class="group hover:bg-gray-50/50 transition-colors">
                                {{-- Customer Details: Sticky Left agar tetap terlihat saat scroll horizontal --}}
                                <td class="px-6 py-6 sticky left-0 bg-white group-hover:bg-gray-50 transition-colors z-10 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                    <div class="flex items-center gap-4">
                                        <div class="shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-400 border border-gray-200 uppercase">
                                            {{ substr($order->user->name ?? $order->username, 0, 1) }}
                                        </div>
                                        <div class="truncate"> {{-- Tambahkan truncate agar nama panjang tidak merusak layout --}}
                                            <div class="text-[12px] font-bold text-gray-900 leading-none mb-1 whitespace-nowrap">
                                                {{ $order->user->name ?? $order->username }}
                                            </div>
                                            <div class="text-[9px] text-gray-400 font-mono italic">
                                                ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-6">
                                    <p class="text-[10px] text-gray-500 leading-relaxed uppercase tracking-tighter max-w-[200px] line-clamp-2">
                                        {{ $order->address }}
                                    </p>
                                </td>

                                <td class="px-4 py-6 text-center">
                                    @if($order->payment_receipt)
                                        <a href="{{ asset('storage/' . $order->payment_receipt) }}" target="_blank" 
                                           class="inline-block bg-black text-white text-[9px] font-bold px-4 py-2 rounded uppercase tracking-widest hover:bg-gray-800 transition shadow-sm whitespace-nowrap">
                                            Show Receipt
                                        </a>
                                    @else
                                        <span class="text-[10px] text-gray-300 italic font-medium whitespace-nowrap">No Upload</span>
                                    @endif
                                </td>

                                <td class="px-4 py-6 text-center">
                                    @php
                                        $statusColor = match($order->status) {
                                            'Paying', 'waiting_confirmation' => 'text-blue-500 bg-blue-50 border-blue-100',
                                            'Shipping' => 'text-green-500 bg-green-50 border-green-100',
                                            'Completed' => 'text-gray-900 bg-gray-100 border-gray-200',
                                            default => 'text-gray-400 bg-gray-50 border-gray-100'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase border whitespace-nowrap {{ $statusColor }}">
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                </td>

                                <td class="px-4 py-6 text-center">
                                    <span class="text-[12px] font-bold text-gray-800 whitespace-nowrap">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-4 py-6 text-center whitespace-nowrap">
                                    <div class="text-[10px] font-bold text-gray-800">{{ $order->updated_at->format('M d, Y') }}</div>
                                    <div class="text-[9px] text-gray-300 font-medium uppercase tracking-tighter">{{ $order->updated_at->format('g:i A') }}</div>
                                </td>

                                <td class="px-6 py-6 text-right">
                                    @if($order->status === 'Paying' || $order->status === 'waiting_confirmation')
                                        <form action="{{ route('admin.transactions.confirm', $order->id) }}" method="POST" class="flex flex-col items-end gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" name="shipping_receipt" placeholder="ENTER RECEIPT NO." required 
                                                class="text-[9px] border-gray-200 rounded px-3 py-2 focus:ring-1 focus:ring-black focus:border-black w-40 outline-none placeholder:text-gray-200 font-bold tracking-widest uppercase">
                                            <button type="submit" class="bg-[#FF3B3B] text-white px-6 py-2 rounded text-[9px] font-bold uppercase tracking-[0.2em] hover:bg-red-600 transition shadow-md active:scale-95 whitespace-nowrap">
                                                Confirm & Ship
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex flex-col items-end">
                                            <span class="text-[9px] font-bold text-gray-300 uppercase tracking-widest px-4 py-2 border border-gray-100 rounded bg-gray-50/50 cursor-not-allowed whitespace-nowrap">
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
                            {{-- ... bagian empty tetap sama ... --}}
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination juga disesuaikan agar lebih rapat di mobile --}}
        @if($orders->hasPages())
            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-[10px] text-gray-400 font-bold tracking-[0.1em] border-t border-gray-50 pt-8">
                <div>
                    SHOWING <span class="text-gray-900">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span> OF {{ $orders->total() }} RESULTS
                </div>
                <div class="flex items-center gap-4">
                    {{ $orders->links('pagination::simple-tailwind') }}
                </div>
            </div>
        @endif
    </div>

    <style>
        /* Sembunyikan scrollbar agar tabel terlihat bersih tapi tetap bisa di-scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>