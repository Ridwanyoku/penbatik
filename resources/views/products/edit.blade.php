<x-app-layout>
    <div class="p-6 max-w-xl mx-auto"
         x-data="{ variants: {{ $product->variants->toJson() }} }">

        <h1 class="text-xl font-bold mb-4">Edit Product</h1>

        <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $product->name }}" class="w-full mb-3 border p-2">
            <input type="number" name="price" value="{{ $product->price }}" class="w-full mb-3 border p-2">
            <input type="text" name="category" value="{{ $product->category }}" class="w-full mb-3 border p-2">

            <textarea name="description" class="w-full mb-3 border p-2">{{ $product->description }}</textarea>

            <img src="{{asset('storage/' . $product->image)}}" class="w-24 mb-3">
            <input type="file" name="image" class="mb-3">

            <h2 class="font-bold mt-4 mb-2">Variants</h2>

            <template x-for="(variant, index) in variants" :key="index">
                <div class="flex gap-2 mb-2">
                    <input type="text" :name="'variants['+index+'][size]'" x-model="variant.size" class="w-1/2 border p-2">
                    <input type="number" :name="'variants['+index+'][stock]'" x-model="variant.stock" class="w-1/2 border p-2">

                    <button type="button" @click="variants.splice(index,1)" class="bg-red-500 text-white px-2">
                        X
                    </button>
                </div>
            </template>

            <button type="button" @click="variants.push({size:'', stock:''})"
                class="bg-gray-500 text-white px-3 py-1 mt-2 rounded">
                + Add Variant
            </button>

            <br><br>

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>