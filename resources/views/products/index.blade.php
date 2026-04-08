<x-app-layout>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Products</h1>
            <p class="text-gray-500 text-sm">Manage your batik collection and inventory</p>
        </div>

        <a href="{{ route('products.create') }}" 
           class="border border-red-500 text-red-500 hover:bg-red-50 px-6 py-2 rounded-full text-xs font-bold uppercase tracking-widest transition">
            Add Product
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
            <span>✅</span> {{ $message }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b text-[10px] uppercase tracking-widest text-gray-400">
                    <th class="py-5 px-8">Details</th>
                    <th class="py-5 px-6">Category</th>
                    <th class="py-5 px-6 text-center">Stock</th>
                    <th class="py-5 px-6">Price</th>
                    <th class="py-5 px-6">Update</th>
                    <th class="py-5 px-8 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($products as $product)
                <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                    <td class="py-5 px-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gray-100 overflow-hidden border border-gray-100 flex-shrink-0">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 leading-tight">{{ $product->name }}</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter mt-1">Updated</p>
                            </div>
                        </div>
                    </td>

                    <td class="py-5 px-6 text-gray-500">
                        {{$product->category}}
                    </td>

                    <td class="py-5 px-6 text-center">
                        <div class="inline-block px-3 py-1 bg-gray-100 rounded-full text-[10px] font-bold text-gray-600 uppercase">
                            {{ $product->variants->sum('stock') }} Items
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1 uppercase">
                            @foreach ($product->variants as $v)
                                {{ $v->size }}:{{ $v->stock }} 
                            @endforeach
                        </div>
                    </td>

                    <td class="py-5 px-6 font-bold text-gray-900">
                        {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td class="py-5 px-6">
                        <p class="text-[10px] font-bold text-gray-900">{{ $product->updated_at->format('M d, Y') }}</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $product->updated_at->format('g:i A') }}</p>
                    </td>

                    <td class="py-5 px-8 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" 
                               class="bg-[#FF3B30] text-white text-[10px] font-bold px-4 py-2 rounded-lg uppercase tracking-widest hover:bg-red-600 transition shadow-sm">
                                Detail
                            </a>
                            
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" 
                                        class="p-2 text-gray-300 hover:text-red-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</x-app-layout>