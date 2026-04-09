<x-user.app>
    <x-slot:title>My Orders | Penbatik</x-slot:title>

    @include('components.user.mini-nav')
        
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-widest">My Orders</h1>
            <p class="text-xs text-gray-400 mt-2 uppercase tracking-widest">Pantau status perjalanan batikmu</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm min-h-[500px]">
            <div class="hidden md:grid grid-cols-12 gap-4 mb-8 pb-4 border-b border-gray-400 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                <div class="col-span-5">Items</div>
                <div class="col-span-2 text-center">Order Id</div>
                <div class="col-span-3 text-center">Status & Tracking</div>
                <div class="col-span-2 text-right">Action</div>
            </div>

            <div class="space-y-12">
                @forelse($orders as $order)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                        
                        {{-- 1. Items Detail Section --}}
                        <div class="col-span-5 space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-20 bg-gray-00 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-[11px] font-bold text-gray-900 uppercase tracking-tight">
                                            {{ $item->product->name }}
                                        </h4>
                                        <p class="text-[9px] text-gray-400 font-medium mt-1 uppercase">
                                            Size: {{ $item->size ?? '-' }} · Qty: {{ $item->quantity ?? 1 }}
                                        </p>
                                        <p class="text-[10px] font-bold text-gray-700 mt-1">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- 2. Order ID --}}
                        <div class="col-span-2 text-center text-[13px] font-mono font-bold text-gray-800 py-2">
                            #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                        </div>

                        {{-- 3. Status & J&T Tracking --}}
                        <div class="col-span-3 flex flex-col items-center gap-3">
                            @php
                                $statusStyles = match($order->status) {
                                    'Paying' => 'border-blue-400 text-blue-500 bg-blue-50/30',
                                    'Shipping' => 'border-green-400 text-green-500 bg-green-50/30',
                                    'Completed' => 'border-gray-900 text-gray-900 bg-gray-50',
                                    'Cancelled' => 'border-red-400 text-red-500 bg-red-50/30',
                                    default => 'border-orange-400 text-orange-500 bg-orange-50/30'
                                };
                            @endphp
                            
                            <span class="px-6 py-2 border {{ $statusStyles }} rounded-full text-[9px] font-bold uppercase tracking-[0.15em]">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>

                            @if($order->shipping_receipt)
                                <div class="text-center">
                                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-1">Track Courier (J&T)</p>
                                    <a href="https://www.jet.co.id/track?bills={{ $order->shipping_receipt }}" 
                                       target="_blank" 
                                       class="group flex items-center gap-2 bg-gray-50 border border-gray-200 px-3 py-2 rounded-lg hover:border-red-500 transition-all">
                                        <span class="text-[14px] font-mono font-black text-gray-800 group-hover:text-red-600">
                                            {{ $order->shipping_receipt }}
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-300 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            
                            @if($order->status === 'Shipping')
                                <form action="{{ route('orders.complete', $order->id) }}" method="POST" class="w-full px-4">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                        {{-- Tambahkan baris onclick di bawah ini --}}
                                        onclick="return confirm('Apakah Master yakin pesanan sudah diterima dengan baik? Tindakan ini tidak dapat dibatalkan.')"
                                        class="w-full bg-green-600 text-white text-[9px] font-bold py-2 rounded uppercase tracking-widest hover:bg-green-700 transition shadow-sm">
                                        Selesaikan Pesanan
                                    </button>
                                </form>
                            @endif
                        </div>

                        {{-- 4. Action --}}
                        <div class="col-span-2 text-right flex flex-col gap-2 items-end">
                            <a href="/payment/{{ $order->id }}" 
                                class="inline-block bg-black text-white px-8 py-3 rounded text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition shadow-sm w-full text-center">
                                Detail Pembayaran
                            </a>

                            @if($order->status === 'pending' && !$order->payment_receipt)
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="w-full">
                                    @csrf @method('PATCH')
                                    <button type="submit" onclick="return confirm('Batalkan pesanan ini?')" 
                                        class="text-[9px] font-bold text-red-500 uppercase tracking-widest hover:underline w-full mt-1">
                                        Cancel Order
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                    <hr class="border-gray-400 my-2">
                @empty
                    <div class="py-32 text-center">
                        <div class="mb-4 text-4xl">📦</div>
                        <p class="text-[10px] font-bold uppercase text-gray-300 tracking-[0.3em]">Belum ada pesanan</p>
                        <a href="/" class="mt-6 inline-block text-[10px] font-bold uppercase text-red-500 underline tracking-widest">Mulai Belanja</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-user.app>