<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Product Detail</h1>

        <img src="/images/{{ $product->image }}" class="w-40 mb-4">

        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Price:</strong> Rp {{ number_format($product->price) }}</p>
        <p><strong>Category:</strong> {{ $product->category }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>

        <h2 class="font-bold mt-4">Variants</h2>

        <table class="w-full border mt-2">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Size</th>
                    <th class="p-2">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->variants as $v)
                <tr class="text-center border-t">
                    <td class="p-2">{{ $v->size }}</td>
                    <td class="p-2">{{ $v->stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('products.index') }}" 
           class="inline-block mt-4 bg-gray-500 text-white px-4 py-2 rounded">
           Back
        </a>
    </div>
</x-app-layout>