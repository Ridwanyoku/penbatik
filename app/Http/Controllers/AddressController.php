<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // AMBIL DATA ALAMAT DARI DATABASE
        $addresses = auth()->user()->addresses()->orderBy('is_default', 'desc')->get();

        // Hitung total (sesuaikan dengan logic Master)
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $delivery = 20000;
        $total = $subtotal + $delivery;

        // KIRIM KE VIEW MENGGUNAKAN COMPACT
        return view('checkout.index', compact('cart', 'addresses', 'subtotal', 'delivery', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:50',
            'receiver_name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'full_address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'is_default' => 'nullable'
        ]);

        $user = auth()->user();
        
        // Logic: Jika ini alamat pertama, otomatis jadi default
        $isFirst = $user->addresses()->count() === 0;
        $setAsDefault = $request->has('is_default') || $isFirst;

        if ($setAsDefault) {
            $user->addresses()->update(['is_default' => false]);
            $validated['is_default'] = true;
        }

        $user->addresses()->create($validated);

        return back()->with('success', 'Address saved.');
    }

    public function setDefault(Address $address)
    {
        if ($address->user_id !== auth()->id()) abort(403);
        
        auth()->user()->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return back();
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== auth()->id()) abort(403);
        $address->delete();
        return back();
    }
}