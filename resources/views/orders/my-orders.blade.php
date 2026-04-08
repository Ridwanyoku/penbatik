<x-user.app>
    <x-slot:title>My Orders | Penbatik</x-slot:title>

    @include('components.user.mini-nav')
        
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-widest">My Orders</h1>
            <p class="text-xs text-gray-400 mt-2 uppercase tracking-widest">Pantau status perjalanan batikmu</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm min-h-[500px]">
            <div class="hidden md:grid grid-cols-12 gap-4 mb-8 pb-4 border-b border-gray-100 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                <div class="col-span-5">Items</div>
                <div class="col-span-2 text-center">Order Id</div>
                <div class="col-span-3 text-center">Status</div>
                <div class="col-span-2 text-right">Action</div>
            </div>

            <div class="space-y-10">
                @forelse($orders as $order)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <div class="col-span-5 flex items-center gap-6">
                            <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0 shadow-sm">
                                @if($order->items->first())
                                    <img src="{{ asset('storage/' . $order->items->first()->product->image) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 uppercase tracking-tight mb-1">
                                    {{ $order->items->first()->product->name ?? 'Batik Product' }}
                                </h4>
                                <p class="text-[10px] text-gray-400 font-medium">
                                    Size: {{ $order->items->first()->size ?? '-' }} · {{ $order->items->count() }} Item(s)
                                </p>
                            </div>
                        </div>

                        <div class="col-span-2 text-center text-[14px] font-mono text-gray-800">
                            {{ $order->id }}
                        </div>

                        <div class="col-span-3 flex flex-col items-center">
                            @php
                                $statusStyles = [
                                    'Paying' => 'border-blue-400 text-blue-500 bg-blue-50/30',
                                    'Shipping' => 'border-green-400 text-green-500 bg-green-50/30',
                                    'Pending' => 'border-orange-400 text-orange-500 bg-orange-50/30',
                                    'Cancelled' => 'border-red-400 text-red-500 bg-red-50/30',
                                ][$order->status] ?? 'border-gray-200 text-gray-400';
                            @endphp
                            
                            <span class="px-6 py-2 border {{ $statusStyles }} rounded-full text-[9px] font-bold uppercase tracking-[0.15em]">
                                {{ $order->status }}
                            </span>

                            @if($order->status === 'Shipping' && $order->shipping_receipt)
                                <span class="text-[9px] text-gray-400 mt-2 font-mono tracking-tighter">
                                    RESI: {{ $order->shipping_receipt }}
                                </span>
                            @endif
                            
                            @if($order->status === 'Shipping')
                                <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="mt-4 w-full bg-green-500 text-white text-[10px] font-bold px-2 py-2 rounded-full uppercase tracking-widest hover:bg-green-600 transition">
                                        Pesanan Diterima
                                    </button>
                                </form>
                            @endif
                        </div>

        
                    <div class="col-span-2 text-right flex flex-col gap-2 items-end">
                        <a href="/payment/{{ $order->id }}" 
                            class="inline-block bg-black text-white px-8 py-3 rounded text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition shadow-sm w-full text-center">
                            Detail
                        </a>

                        {{-- Tombol CANCEL: Muncul hanya jika status 'Paying' dan BELUM upload bukti --}}
                        @if($order->status === 'pending' && !$order->payment_receipt)
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="w-full">
                                @csrf @method('PATCH')
                                <button type="submit" onclick="return confirm('Batalkan pesanan ini?')" 
                                    class="text-[9px] font-bold text-red-500 uppercase tracking-widest hover:underline w-full mt-2">
                                    Cancel Order
                                </button>
                            </form>
                        @endif

                        {{-- @if($order->status === 'Completed')
                            <a href="{{ route('orders.refund.create', $order->id) }}" 
                                class="text-[9px] font-bold text-orange-500 uppercase tracking-widest hover:underline w-full mt-2 text-center">
                                Ajukan Refund
                            </a>
                        @endif
                        
                        @if($order->status === 'Refund_Requested')
                            <span class="text-[9px] font-bold text-blue-400 uppercase tracking-widest italic">
                                Refund sedang ditinjau
                            </span>
                        @endif --}}
                    </div>

                    </div>
                    <hr class="border-gray-50">
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