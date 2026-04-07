<x-user.app>
    <x-slot:title>{{ $product->name }} | Penbatik</x-slot:title>

    <div x-data="{ 
    selectedSize: '', 
    qty: 1, 
    async addToCart() {
        if(!this.selectedSize) { alert('Pilih ukuran!'); return; }
        
        const response = await fetch('{{ route('cart.add') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: {{ $product->id }},
                size: this.selectedSize,
                qty: this.qty
            })
        });

        if(response.ok) {
            alert('Berhasil masuk keranjang!');
            window.location.href = '{{ route('cart.index') }}'; // Langsung ke halaman cart
        }
    }
}">
        
        <a href="/" class="inline-block mb-8 text-gray-500 hover:text-black">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                </div>
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover brightness-90">
                </div>
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover scale-110">
                </div>
            </div>

            <div class="flex flex-col">
                <h1 class="text-2xl font-bold uppercase tracking-wider mb-2">{{ $product->name }}</h1>
                <p class="text-lg text-gray-600 mb-8">Rp {{ number_format($product->price, 0, ',', '.') }},00</p>

                <div class="mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest block mb-4 text-gray-400">
                        Ukuran: <span class="text-black" x-text="selectedSize"></span>
                    </span>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->variants as $variant)
                            <button 
                                @click="selectedSize = '{{ $variant->size }}'; stock = {{ $variant->stock }}"
                                :class="selectedSize === '{{ $variant->size }}' ? 'bg-black text-white border-black' : 'border-gray-200 text-gray-600'"
                                class="px-4 py-2 border text-xs font-bold rounded transition-all hover:border-black {{ $variant->stock <= 0 ? 'opacity-30 cursor-not-allowed' : '' }}"
                                {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                {{ $variant->size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <div class="flex items-center border border-black rounded px-4 py-2">
                        <button @click="if(qty > 1) qty--" class="text-xl font-light outline-none">-</button>
                        <input type="number" x-model="qty" readonly class="w-12 text-center border-none focus:ring-0 text-sm bg-transparent">
                        <button @click="qty++" class="text-xl font-light outline-none">+</button>
                    </div>
                    
                    <button @click="addToCart()" class="flex-grow bg-[#0a0a0a] text-white py-3 rounded text-sm font-bold uppercase tracking-widest hover:bg-gray-800 transition">
                        Add to Cart
                    </button>
                </div>

                <button @click="checkout()" class="w-full border border-black py-3 rounded text-sm font-bold uppercase tracking-widest hover:bg-black hover:text-white transition">
                    Checkout
                </button>

                <div class="mt-12 pt-12 border-t border-gray-100">
                    <h4 class="text-xs font-bold uppercase tracking-[0.2em] mb-6">Description</h4>
                    <div class="text-sm text-gray-600 leading-relaxed space-y-4 font-light">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user.app>