<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Menambah produk ke keranjang (AJAX/Fetch)
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // ID Unik: Gabungan ID Produk dan Ukuran
        $cartId = $request->product_id . '-' . $request->size;

        if(isset($cart[$cartId])) {
            $cart[$cartId]['qty'] += $request->qty;
        } else {
            $cart[$cartId] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $request->qty,
                "price" => $product->price,
                "size" => $request->size,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Item added to cart!',
            'cart_count' => count(session('cart'))
        ]);
    }
}