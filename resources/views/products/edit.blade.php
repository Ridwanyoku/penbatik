<x-app-layout>
    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-black transition flex items-center gap-2">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Products
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit: {{ $product->name }}</h1>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full border-gray-100 bg-gray-50 rounded-xl focus:ring-0">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-2">Price</label>
                            <input type="number" name="price" value="{{ $product->price }}" required class="w-full border-gray-100 bg-gray-50 rounded-xl focus:ring-0">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-2">Category</label>
                            <select name="category" required class="w-full border-gray-100 bg-gray-50 rounded-xl focus:ring-0">
                                <option value="Pria" {{ $product->category == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ $product->category == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-2">Description</label>
                        <textarea name="description" rows="4" required class="w-full border-gray-100 bg-gray-50 rounded-xl focus:ring-0">{{ $product->description }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-20 h-20 rounded-lg object-cover">
                        <div>
                            <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400 block mb-2">Change Image (Optional)</label>
                            <input type="file" name="image" class="text-xs text-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Inventory Variants</label>
                        <button type="button" onclick="addVariant()" class="text-[10px] font-bold text-red-500 uppercase">+ Add Size</button>
                    </div>

                    <div id="variant-container" class="space-y-4">
                        @foreach($product->variants as $index => $variant)
                        <div class="grid grid-cols-5 gap-2 items-center variant-row">
                            <div class="col-span-3">
                                <input type="text" name="variants[{{ $index }}][size]" value="{{ $variant->size }}" required class="w-full border-gray-100 bg-gray-50 rounded-lg text-xs">
                            </div>
                            <div class="col-span-2 flex items-center gap-2">
                                <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant->stock }}" required class="w-full border-gray-100 bg-gray-50 rounded-lg text-xs">
                                <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-gray-300 hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white text-xs font-bold py-4 rounded-2xl uppercase hover:shadow-lg transition">
                    Update Product
                </button>
            </div>
        </div>
    </form>

    <script>
        let variantIndex = {{ $product->variants->count() }};
        function addVariant() {
            const container = document.getElementById('variant-container');
            const html = `
                <div class="grid grid-cols-5 gap-2 items-center variant-row">
                    <div class="col-span-3">
                        <input type="text" name="variants[${variantIndex}][size]" placeholder="Size" required class="w-full border-gray-100 bg-gray-50 rounded-lg text-xs">
                    </div>
                    <div class="col-span-2 flex items-center gap-2">
                        <input type="number" name="variants[${variantIndex}][stock]" placeholder="Stock" required class="w-full border-gray-100 bg-gray-50 rounded-lg text-xs">
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-gray-300 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
            variantIndex++;
        }
    </script>
</x-app-layout>