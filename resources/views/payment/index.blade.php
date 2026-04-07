<x-user.app>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-6">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-sm p-12">
            
            <div class="space-y-8">
                <div class="flex justify-between items-center border-b pb-6">
                    <span class="text-gray-400 italic">Total Payment</span>
                    <span class="text-xl font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-400 italic">Bank Transfer</span>
                    <img src="{{ asset('images/bca.png') }}" class="h-8" alt="BCA">
                </div>

                <div class="flex justify-between items-start">
                    <span class="text-gray-400 italic">Bank Account</span>
                    <div class="text-right">
                        <p class="font-bold tracking-widest text-lg">121212121212121212</p>
                        <button class="text-blue-500 text-xs font-bold uppercase mt-1">Copy</button>
                    </div>
                </div>

                <div class="flex justify-between items-center border-b pb-6">
                    <span class="text-gray-400 italic">Order ID</span>
                    <span class="font-bold">#{{ $order->id }}</span>
                </div>

                <div class="pt-4">
                    <p class="text-gray-400 italic mb-4">Send the payment receipt</p>
                    
                    <a href="{{ route('payment.receipt', $order->id) }}">
                        <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden border">
                            @if($order->payment_receipt)
                                <img src="{{ asset('storage/' . $order->payment_receipt) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            @endif
                        </div>
                    </a>

                    @if($order->status == 'waiting_confirmation')
                        <p class="mt-4 text-[10px] font-bold text-orange-500 uppercase italic tracking-widest">
                            STATUS: WAITING FOR STAFF TO CONFIRM...
                        </p>
                    @endif
                </div>
            </div>

            <div class="mt-12">
                <a href="{{ route('dashboard') }}" class="block w-full bg-black text-white text-center py-4 rounded-lg font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition">
                    Back to Account
                </a>
            </div>
        </div>
    </div>
</x-user.app>