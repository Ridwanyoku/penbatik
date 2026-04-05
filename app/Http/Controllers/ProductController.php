<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->latest()->paginate(5);
        
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048',

            'variants' => 'required|array',
            'variants.*.size' => 'required',
            'variants.*.stock' => 'required|integer',
        ]);

        $validated['image'] = $request->file('image')
            ->store('products', 'public');

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $validated['image'],
        ]);

        foreach ($validated['variants'] as $variant) {
            $product->variants()->create([
                'size' => $variant['size'],
                'stock' => $variant['stock'],
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('variants');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('variants');
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',

            'image' => 'nullable|image|max:2048',

            'variants' => 'required|array',
            'variants.*.size' => 'required',
            'variants.*.stock' => 'required|integer',
        ]);

        $imagePath = $product->image;

        // Cek jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $imagePath
        ]);

        $product->variants()->delete();

        foreach ($validated['variants'] as $variant) {
            $product->variants()->create([
                'size' => $variant['size'],
                'stock' => $variant['stock'],
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}