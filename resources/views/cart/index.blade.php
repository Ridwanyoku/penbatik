<x-user.app>
    <div class="max-w-7xl mx-auto px-10 py-12">
        <h1 class="text-2xl font-bold uppercase tracking-widest mb-10">Your Cart</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2 space-y-6">
                    @foreach(session('cart') as $id => $details)
                        <div class="flex gap-6 border-b pb-6">
                            <img src="{{ asset('storage/' . $details['image']) }}" class="w-24 h-32 object-cover rounded">
                            <div class="flex-grow">
                                <h3 class="font-bold uppercase text-sm">{{ $details['name'] }}</h3>
                                <p class="text-xs text-gray-500 mt-1">Size: {{ $details['size'] }}</p>
                                <p class="text-sm mt-4 font-semibold">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm">Qty: {{ $details['quantity'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-gray-50 p-8 rounded-lg h-fit">
                    <h2 class="font-bold uppercase text-xs tracking-widest mb-6">Order Summary</h2>
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $item)
                        @php $total += $item['price'] * $item['quantity'] @endphp
                    @endforeach
                    
                    <div class="flex justify-between mb-4 text-sm">
                        <span>Subtotal</span>
                        <span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <button onclick="window.location.href='{{ route('checkout.index') }}'" 
                            class="w-full bg-black text-white py-4 rounded text-xs font-bold uppercase tracking-widest mt-6">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        @else
            <p class="text-center py-20 text-gray-400">Keranjang kamu masih kosong.</p>
        @endif
    </div>
</x-user.app>