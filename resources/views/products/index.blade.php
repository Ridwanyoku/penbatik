<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Product List</h1>

        <a href="{{ route('products.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded">
           + Add Product
        </a>

        @if ($message = Session::get('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
                {{ $message }}
            </div>
        @endif

        <div class="mt-6 overflow-x-auto">
            <table class="w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">No</th>
                        <th class="p-2">Image</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Stock</th>
                        <th class="p-2">Variants</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="text-center border-t">
                        <td class="p-2">{{ ++$i }}</td>

                        <td class="p-2">
                            <img src="/images/{{ $product->image }}" class="w-16 mx-auto">
                        </td>

                        <td class="p-2">{{ $product->name }}</td>

                        <td class="p-2">Rp {{ number_format($product->price) }}</td>

                        <td class="p-2">
                            {{ $product->variants->sum('stock') }}
                        </td>

                        <td class="p-2 text-sm">
                            @foreach ($product->variants as $v)
                                <div>{{ $v->size }} ({{ $v->stock }})</div>
                            @endforeach
                        </td>

                        <td class="p-2 space-x-2">
                            <a href="{{ route('products.show',$product->id) }}" 
                               class="bg-green-500 text-white px-2 py-1 rounded">Show</a>

                            <a href="{{ route('products.edit',$product->id) }}" 
                               class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>

                            <form action="{{ route('products.destroy',$product->id) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Yakin hapus?')" 
                                        class="bg-red-500 text-white px-2 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>