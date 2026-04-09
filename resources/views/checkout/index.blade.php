<x-user.app>
    <div class="max-w-4xl mx-auto px-10 py-12">
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('cart.index') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold uppercase tracking-[0.3em]">Checkout</h1>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="space-y-16">
                
                <div>
                    <div class="flex justify-between items-end mb-8">
                        <h2 class="font-bold text-sm uppercase tracking-[0.2em]">Shipping Destination</h2>
                        <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold text-blue-500 uppercase tracking-widest hover:underline italic">
                            + Manage Addresses
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($addresses as $address)
                            <label class="group relative border border-gray-100 rounded-2xl p-6 cursor-pointer transition-all hover:border-black has-[:checked]:border-black has-[:checked]:bg-gray-50/50">
                                {{-- Input Radio Tersembunyi --}}
                                <input type="radio" name="address_id" value="{{ $address->id }}" class="hidden peer" {{ $address->is_default ? 'checked' : '' }} required>
                                
                                <div class="flex flex-col h-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="text-[9px] font-black uppercase tracking-[0.2em] {{ $address->is_default ? 'text-red-500' : 'text-gray-400' }}">
                                            {{ $address->label }} {{ $address->is_default ? '(Primary)' : '' }}
                                        </span>
                                        {{-- Ikon Checkmark saat dipilih --}}
                                        <div class="opacity-0 group-has-[:checked]:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>

                                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">{{ $address->name }}</h3>
                                    <p class="text-[11px] text-gray-500 mt-1 italic">{{ $address->receiver_name }} ({{ $address->phone_number }})</p>
                                    
                                    <p class="text-[10px] text-gray-400 leading-relaxed uppercase tracking-tighter mt-4">
                                        {{ $address->full_address }}, {{ $address->city }} <br>
                                        {{ $address->postal_code }}
                                    </p>
                                </div>
                            </label>
                        @empty
                            <div class="col-span-full py-12 border border-dashed border-gray-200 rounded-3xl text-center bg-gray-50/30">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 italic">No saved address found</p>
                                <a href="{{ route('profile.edit') }}" class="inline-block bg-black text-white px-8 py-3 rounded-lg text-[9px] font-bold uppercase tracking-[0.2em]">Add Your First Address</a>
                            </div>
                        @endforelse
                    </div>
                    @error('address_id')
                        <p class="text-red-500 text-[10px] mt-4 uppercase font-bold tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <h2 class="font-bold text-sm uppercase tracking-[0.2em] mb-8 text-gray-300">Items Summary</h2>
                    <div class="space-y-6">
                        @foreach($cart as $item)
                        <div class="flex justify-between items-center group">
                            <div class="flex items-center gap-6">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-20 object-cover rounded-lg grayscale group-hover:grayscale-0 transition-all duration-500">
                                    <span class="absolute -top-2 -right-2 bg-black text-white text-[9px] w-5 h-5 flex items-center justify-center rounded-full font-bold">{{ $item['quantity'] }}</span>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-widest">{{ $item['name'] }}</p>
                                    <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] mt-1">Size: {{ $item['size'] }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold tracking-tighter">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-10 space-y-4">
                    <div class="flex justify-between text-[11px] uppercase tracking-widest">
                        <span class="text-gray-400 italic">Subtotal</span>
                        <span class="font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-[11px] uppercase tracking-widest">
                        <span class="text-gray-400 italic">Delivery Fee</span>
                        <span class="font-bold">Rp {{ number_format($delivery, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xl pt-6">
                        <span class="text-gray-400 italic font-light">Grand Total</span>
                        <span class="font-black underline decoration-1 underline-offset-[12px]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-5 rounded-2xl font-bold uppercase tracking-[0.4em] hover:bg-gray-800 transition-all shadow-xl shadow-gray-100 active:scale-[0.98]">
                    PLACE ORDER
                </button>
            </div>
        </form>
    </div>
</x-user.app>