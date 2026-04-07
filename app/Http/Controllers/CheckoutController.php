<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $delivery = 20000;
        $total = $subtotal + $delivery;

        return view('checkout.index', compact('cart', 'subtotal', 'delivery', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'address' => 'required|string|min:10',
        ]);

        $cart = session()->get('cart', []);

        $order = DB::transaction(function () use ($request, $cart) {
            $subtotal = 0;
            foreach($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'username' => $request->username,
                'address' => $request->address,
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