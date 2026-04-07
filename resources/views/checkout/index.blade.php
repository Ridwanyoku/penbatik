<x-user.app>
    <div class="max-w-4xl mx-auto px-10 py-12">
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('cart.index') }}"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
            <h1 class="text-xl font-bold uppercase tracking-widest">Checkout</h1>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="space-y-12">
                <div>
                    <h2 class="font-bold text-sm uppercase tracking-widest mb-6">Shipping Address</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-3 items-center border-b border-gray-100 py-4">
                            <span class="text-gray-400 italic text-sm">Username</span>
                            <input type="text" name="username" value="{{ Auth::user()->name }}" class="col-span-2 border-none text-right font-bold focus:ring-0">
                        </div>
                        <div class="grid grid-cols-3 items-start border-b border-gray-100 py-4">
                            <span class="text-gray-400 italic text-sm">Shipping to</span>
                            <textarea name="address" required placeholder="Tulis alamat lengkap disini..." class="col-span-2 border-none text-right focus:ring-0 min-h-[100px] text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="font-bold text-sm uppercase tracking-widest mb-6">Details Items</h2>
                    <div class="space-y-4">
                        @foreach($cart as $item)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-12 h-16 object-cover rounded">
                                <div>
                                    <p class="text-[11px] font-bold uppercase">{{ $item['name'] }} - {{ $item['size'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $item['quantity'] }}x</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t pt-8 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400 italic">Subtotal</span>
                        <span class="font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400 italic">Delivery</span>
                        <span class="font-bold">Rp {{ number_format($delivery, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-lg pt-4">
                        <span class="text-gray-400 italic">Total</span>
                        <span class="font-bold underline decoration-1 underline-offset-8">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition">
                    ORDER
                </button>
            </div>
        </form>
    </div>
</x-user.app>