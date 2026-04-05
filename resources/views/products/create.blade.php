<x-app-layout>
    <div class="p-6 max-w-xl mx-auto" x-data="{ variants: [{size:'', stock:''}] }">
        <h1 class="text-xl font-bold mb-4">Add Product</h1>

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" placeholder="Name" class="w-full mb-3 border p-2">
            <input type="number" name="price" placeholder="Price" class="w-full mb-3 border p-2">
            <input type="text" name="category" placeholder="Category" class="w-full mb-3 border p-2">

            <textarea name="description" placeholder="Description" class="w-full mb-3 border p-2"></textarea>

            <input type="file" name="image" class="mb-3">

            <h2 class="font-bold mt-4 mb-2">Variants</h2>

            <template x-for="(variant, index) in variants" :key="index">
                <div class="flex gap-2 mb-2">
                    <input type="text" :name="'variants['+index+'][size]'" placeholder="Size" class="w-1/2 border p-2">
                    <input type="number" :name="'variants['+index+'][stock]'" placeholder="Stock" class="w-1/2 border p-2">

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

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>