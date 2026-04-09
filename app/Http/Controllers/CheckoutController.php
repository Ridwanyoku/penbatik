<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Model\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $addresses = auth()->user()->addresses()->orderBy('is_default', 'desc')->get();
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $delivery = 20000;
        $total = $subtotal + $delivery;

        return view('checkout.index', compact('cart', 'addresses', 'subtotal', 'delivery', 'total'));
    }

    public function store(Request $request)
    {
        // 1. Update Validasi: Sesuaikan dengan input dari view baru
        $request->validate([
            'address_id' => 'required|exists:addresses,id,user_id,' . Auth::id(),
        ]);

        $cart = session()->get('cart', []);

        // Proteksi jika cart kosong tapi paksa akses store
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($request, $cart) {
            // Ambil data alamat lengkap dari database untuk diarsipkan di tabel order
            $selectedAddress = \App\Models\Address::findOrFail($request->address_id);

            $subtotal = 0;
            foreach($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                // Simpan referensi ID alamat
                'address_id' => $selectedAddress->id, 
                // Ambil nama dari alamat (untuk kolom username/receiver_name Master)
                'username' => $selectedAddress->receiver_name, 
                // Gabungkan alamat lengkap ke kolom address agar data di order tetap ada jika alamat dihapus nanti
                'address' => "{$selectedAddress->full_address}, {$selectedAddress->city}, {$selectedAddress->postal_code} ({$selectedAddress->phone_number})",
                'subtotal' => $subtotal,
                'delivery' => 20000,
                'total' => $subtotal + 20000,
                'status' => 'pending'
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart');

            return $order;
        });

        return redirect()->route('payment.index', ['order' => $order->id])->with('success', 'Order berhasil dibuat!');
    }

    public function payment(Order $order)
    {

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.index', compact('order'));
    }

    public function receipt(Order $order)
    {
        if ($order->user_id !== auth()->id()) { abort(403); }
        
        return view('payment.receipt', compact('order'));
    }

    public function uploadReceipt(Request $request, Order $order)
{
    $request->validate([
        'payment_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('payment_receipt')) {
            if ($order->payment_receipt && \Storage::disk('public')->exists($order->payment_receipt)) {
                \Storage::disk('public')->delete($order->payment_receipt);
            }

            $path = $request->file('payment_receipt')->store('receipts', 'public');
            
            $order->payment_receipt = $path;
            $order->status = 'waiting_confirmation';
            $order->save();
        }

        return redirect()->route('payment.index', $order->id)->with('success', 'Bukti transfer berhasil diperbarui!');
    }
}