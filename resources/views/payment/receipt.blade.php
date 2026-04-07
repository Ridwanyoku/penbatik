<x-user.app>
    <div class="max-w-md mx-auto py-20 px-6">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
            <h2 class="text-lg font-bold uppercase tracking-widest mb-2">Upload Receipt</h2>
            <p class="text-gray-400 text-sm italic mb-8">Order #{{ $order->id }}</p>

            <form action="{{ route('payment.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-8">
                    <label class="block group cursor-pointer">
                        <div class="aspect-[3/4] w-full bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden group-hover:border-black transition">
                            @if($order->payment_receipt)
                                <img src="{{ asset('storage/' . $order->payment_receipt) }}" class="w-full h-full object-contain">
                            @else
                                <div class="text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="text-xs font-bold uppercase">Click to Select Photo</span>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="payment_receipt" class="hidden" onchange="this.form.submit()">
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('payment.index', $order->id) }}" class="py-3 border border-black rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="button" onclick="window.history.back()" class="py-3 bg-black text-white rounded-lg text-xs font-bold uppercase tracking-widest">
                        Save & Back
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-user.app>