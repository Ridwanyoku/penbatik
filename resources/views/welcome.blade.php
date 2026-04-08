<x-user.app>
    <x-slot:title>Welcome to Penbatik</x-slot:title>

    <section class="flex flex-col md:flex-row w-full">
        <div class="relative w-full md:w-1/2 h-[500px] overflow-hidden group">
            <img src="{{asset('/images/woman.jpg')}}" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Woman">
            <div class="absolute inset-0 bg-black/20 flex flex-col items-center justify-center text-white">
                <h2 class="text-4xl tracking-[0.2em] font-serif font-bold uppercase mb-2">Woman</h2>
                <p class="logo-font text-3xl italic">Collection</p>
            </div>
        </div>
        <div class="relative w-full md:w-1/2 h-[500px] overflow-hidden group">
            <img src="{{asset('/images/man.jpg')}}" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Man">
            <div class="absolute inset-0 bg-black/20 flex flex-col items-center justify-center text-white">
                <h2 class="text-4xl tracking-[0.2em] font-serif font-bold uppercase mb-2">Man</h2>
                <p class="logo-font text-3xl italic">Collection</p>
            </div>
        </div>
    </section>

    <section class="px-10 py-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-10">
            @forelse($products as $product)
                <div class="group cursor-pointer">
                    <div class="aspect-[3/4] bg-[#f3f3f3] rounded-md overflow-hidden mb-3">
                        <a href="{{ route('product.show', $product->id) }}" class="group cursor-pointer">
                            <div class="aspect-[3/4] bg-[#f3f3f3] rounded-md overflow-hidden mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                            </div>
                        </a>
                    </div>
                    <div class="text-left">
                        <h3 class="text-[11px] font-bold uppercase tracking-tight text-gray-900 mb-1">{{ $product->name }}</h3>
                        <p class="text-[11px] font-medium text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }},00</p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 uppercase tracking-widest text-xs">No products found</p>
            @endforelse
        </div>
    </section>
</x-user.app>