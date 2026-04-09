<x-user.app>
    <x-slot:title>{{ $product->name }} | Penbatik</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 lg:py-12" x-data="{ 
        selectedSize: '', 
        qty: 1, 
        loading: false,
        async addToCart() {
            if(!this.selectedSize) { alert('Pilih ukuran!'); return; }
            
            this.loading = true;
            try {
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
                    alert('Berhasil ditambahkan ke keranjang!');
                }
            } catch (error) {
                alert('Gagal menambahkan ke keranjang.');
            } finally {
                this.loading = false;
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
        
        <a href="/" class="inline-flex items-center gap-2 mb-8 text-black hover:-translate-x-1 transition-transform group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="text-[10px] font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">Back</span>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-16 items-start">
            
            <div class="md:col-span-5 flex justify-center md:justify-start">
                <div class="w-full max-w-sm aspect-[2/3] bg-gray-50 rounded-sm overflow-hidden shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="md:col-span-7 flex flex-col">
                <div class="mb-8">
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2 leading-tight uppercase tracking-tight">{{ $product->name }}</h1>
                    <p class="text-xl font-medium text-gray-800 tracking-tighter">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mb-10 max-w-md">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Pilih Ukuran</span>
                        <span class="text-[9px] text-red-500 font-bold uppercase tracking-widest" x-show="!selectedSize">* Required</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->variants as $variant)
                            <button 
                                @click="selectedSize = '{{ $variant->size }}'"
                                :class="selectedSize === '{{ $variant->size }}' ? 'bg-black text-white border-black ring-1 ring-black ring-offset-2' : 'bg-gray-50 text-gray-500 border-gray-100 hover:border-gray-900'"
                                class="w-12 h-12 border text-[11px] font-bold rounded flex items-center justify-center transition-all {{ $variant->stock <= 0 ? 'opacity-20 cursor-not-allowed' : '' }}"
                                {{ $variant->stock <= 0 ? 'disabled' : '' }}>
                                {{ $variant->size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col gap-4 max-w-md">
                    <div class="flex flex-col sm:flex-row items-stretch gap-4">
                        <div class="flex items-center justify-between bg-black rounded h-14 px-4 sm:w-40">
                            <button @click="if(qty > 1) qty--" class="text-white text-2xl font-light hover:text-red-500 transition-colors cursor-pointer w-8">-</button>
                            <input type="number" x-model="qty" readonly 
                                class="w-12 text-center border-none focus:ring-0 text-base bg-transparent text-white font-black appearance-none">
                            <button @click="qty++" class="text-white text-2xl font-light hover:text-green-500 transition-colors cursor-pointer w-8">+</button>
                        </div>
                        
                        @auth
                            <button @click="addToCart()" 
                                :disabled="loading"
                                class="flex-grow bg-black text-white h-14 rounded text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition active:scale-95 disabled:opacity-50">
                                <span x-show="!loading">Add to Cart</span>
                                <span x-show="loading">Adding...</span>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="flex-grow bg-black text-white h-14 rounded text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition active:scale-95 flex items-center justify-center">
                                Add to Cart
                            </a>
                        @endauth
                    </div>

                    @auth
                        <button @click="checkout()" class="w-full bg-[#111111] text-white h-14 rounded text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-black transition shadow-lg active:scale-95">
                            Buy Now / Checkout
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="w-full bg-[#111111] text-white h-14 rounded text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-black transition shadow-lg active:scale-95 flex items-center justify-center">
                            Buy Now / Checkout
                        </a>
                    @endauth
                </div>

                <div class="mt-8 grid grid-cols-2 gap-4 py-6 border-y border-gray-50 max-w-md">
                    <div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest block">Ketersediaan</span>
                        <span class="text-[11px] font-bold text-green-600 uppercase">Ready Stock</span>
                    </div>
                    <div>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest block">Pengiriman</span>
                        <span class="text-[11px] font-bold text-gray-800 uppercase tracking-tighter">J&T Express</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 lg:mt-24 max-w-3xl">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] mb-6 text-gray-900 border-b border-gray-100 pb-4">Description</h4>
            <div class="text-[13px] lg:text-sm text-gray-500 leading-relaxed font-light space-y-4 text-justify">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</x-user.app>