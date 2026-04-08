<x-user.app>
    <x-slot:title>{{ $product->name }} | Penbatik</x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12" x-data="{ 
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
                window.location.href = '{{ route('cart.index') }}';
            }
        },
        async checkout() {
            if(!this.selectedSize) { alert('Pilih ukuran dulu!'); return; }
            
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
                window.location.href = '{{ route('checkout.index') }}';
            }
        }
    }">
        
        <a href="/" class="inline-block mb-10 text-black hover:scale-110 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
            
            <div class="w-full aspect-[3/4] bg-gray-50 rounded-sm overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
            </div>

            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-tight">{{ $product->name }}</h1>
                <p class="text-lg text-gray-500 mb-10">Rp {{ number_format($product->price, 0, ',', '.') }},00</p>

                <div class="mb-10">
                    <span class="text-[10px] font-bold uppercase tracking-widest block mb-4 text-gray-400">Ukuran</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->variants as $variant)
                            <button 
                                @click="selectedSize = '{{ $variant->size }}'"
                                :class="selectedSize === '{{ $variant->size }}' ? 'bg-black text-white border-black' : 'bg-gray-100 text-gray-400 border-transparent'"
                                class="w-12 h-10 border text-[10px] font-bold rounded flex items-center justify-center transition-all hover:border-black {{ $variant->stock <= 0 ? 'opacity-20 cursor-not-allowed' : '' }}"
                                {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                {{ $variant->size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center bg-black rounded h-12 px-4">
                            <button @click="if(qty > 1) qty--" class="text-white text-xl font-light">-</button>
                            <input type="number" x-model="qty" readonly class="w-10 text-center border-none focus:ring-0 text-sm bg-transparent text-white font-bold">
                            <button @click="qty++" class="text-white text-xl font-light">+</button>
                        </div>
                        
                        <button @click="addToCart()" class="flex-grow bg-black text-white h-12 rounded text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition">
                            Add to Cart
                        </button>
                    </div>

                    <button @click="checkout()" class="w-full bg-[#111111] text-white h-12 rounded text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-black transition shadow-sm">
                        Checkout
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-20 max-w-3xl">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] mb-6 text-gray-900 border-b border-gray-100 pb-4">Description</h4>
            <div class="text-sm text-gray-500 leading-relaxed font-light space-y-4">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>
</x-user.app>