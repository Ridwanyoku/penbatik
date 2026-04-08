<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * SISI ADMIN: Menampilkan semua transaksi
     */
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->paginate(10);
        return view('transactions.index', compact('orders'));
    }
    
    public function myOrders() // Fungsi baru khusus Customer
    {
        $orders = Order::where('user_id', auth()->id())
                    ->with('items.product')
                    ->latest()
                    ->get();

        return view('orders.my-orders', compact('orders'));
    }
    /**
     * SISI ADMIN: Konfirmasi Pembayaran & Input Resi
     */
    public function confirmPayment(Request $request, Order $order)
    {
        $request->validate([
            'shipping_receipt' => 'required|string|max:100',
        ]);

        $order->update([
            'shipping_receipt' => $request->shipping_receipt,
            'status' => 'Shipping'
        ]);
        
        return back()->with('success', 'Pesanan dikonfirmasi dan resi telah dikirim.');
    }

    public function completeOrder(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->update([
            'status' => 'Completed'
        ]);

        return back()->with('success', 'Terima kasih! Pesanan telah selesai.');
    }

    public function cancel(Order $order)
    {
        // Proteksi: Jika sudah ada payment_receipt, tidak bisa cancel
        if ($order->payment_receipt) {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan karena bukti bayar sudah dikirim.');
        }

        $order->update(['status' => 'Cancelled']);
        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
