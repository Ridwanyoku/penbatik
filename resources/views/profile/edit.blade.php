@if(Auth::user()->role === 'admin')
    <x-app-layout>
        <div class="p-12">
            <div class="mb-12">
                <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-[0.3em]">Account Settings</h1>
                <p class="text-[10px] text-gray-400 mt-2 uppercase tracking-widest font-bold">Configure your administrative profile</p>
            </div>

            <div class="max-w-4xl space-y-8">
                <div class="p-10 bg-white border border-gray-100 rounded-3xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-10 bg-white border border-gray-100 rounded-3xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                {{-- Tombol Delete Dihilangkan untuk Admin demi Keamanan --}}
            </div>
        </div>
    </x-app-layout>
@else
    <x-user.app>
        <x-slot:title>My Profile | Penbatik</x-slot:title>

        @include('components.user.mini-nav')

        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="mb-12">
                <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-[0.2em]">Profile</h1>
                <p class="text-xs text-gray-400 mt-2 uppercase tracking-widest">Pengaturan akun anda</p>
            </div>

            <div class="space-y-8">
                {{-- Form Update Info --}}
                <div class="p-8 md:p-12 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Form Update Password --}}
                <div class="p-8 md:p-12 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                
                {{-- Address edit --}}
                <div class="p-10 bg-white border border-gray-100 rounded-3xl shadow-sm mt-8">
                    <h2 class="text-lg font-bold uppercase tracking-[0.2em] mb-8">Shipping Addresses</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        @foreach(Auth::user()->addresses as $addr)
                            <div class="p-6 border {{ $addr->is_default ? 'border-black' : 'border-gray-100' }} rounded-2xl relative bg-white">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-red-500">{{ $addr->label }}</span>
                                    @if(!$addr->is_default)
                                        <form action="{{ route('addresses.set-default', $addr) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="text-[9px] font-bold uppercase tracking-widest text-gray-400 hover:text-black">Set Default</button>
                                        </form>
                                    @endif
                                </div>
                                <h4 class="font-bold text-sm">{{ $addr->name }} <span class="text-gray-400 font-normal">({{ $addr->receiver_name }})</span></h4>
                                <p class="text-[11px] text-gray-500 mt-2 italic">{{ $addr->full_address }}, {{ $addr->city }}</p>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ route('addresses.store') }}" method="POST" class="border-t pt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div class="space-y-4 col-span-2 md:col-span-1">
                            <input type="text" name="name" placeholder="ADDRESS NAME (E.G. MY APARTMENT)" class="w-full border-gray-100 rounded-xl text-[11px] uppercase tracking-widest focus:ring-black">
                            <input type="text" name="label" placeholder="LABEL (E.G. HOME, OFFICE)" class="w-full border-gray-100 rounded-xl text-[11px] uppercase tracking-widest focus:ring-black">
                            <input type="text" name="receiver_name" placeholder="RECEIVER NAME" class="w-full border-gray-100 rounded-xl text-[11px] uppercase tracking-widest focus:ring-black">
                        </div>
                        <div class="space-y-4 col-span-2 md:col-span-1">
                            <input type="text" name="phone_number" placeholder="PHONE NUMBER" class="w-full border-gray-100 rounded-xl text-[11px] focus:ring-black">
                            <input type="text" name="city" placeholder="CITY" class="w-full border-gray-100 rounded-xl text-[11px] uppercase tracking-widest focus:ring-black">
                            <input type="text" name="postal_code" placeholder="POSTAL CODE" class="w-full border-gray-100 rounded-xl text-[11px] focus:ring-black">
                        </div>
                        <textarea name="full_address" placeholder="FULL ADDRESS" class="col-span-2 w-full border-gray-100 rounded-xl text-[11px] focus:ring-black h-24"></textarea>
                        
                        <div class="col-span-2 flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_default" value="1" class="rounded border-gray-200 text-black focus:ring-black">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Set as primary address</span>
                            </label>
                            <button class="bg-black text-white px-10 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:bg-gray-800 transition">Save Address</button>
                        </div>
                    </form>
                </div>

                {{-- TOMBOL SIGN OUT (Lokasi Di Atas Delete Account) --}}
                <div class="p-8 md:p-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900 uppercase tracking-tight my-3">Sign Out</h2>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-black text-white px-8 py-3 rounded text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition shadow-sm">
                                Confirm Sign Out
                            </button>
                        </form>
                    </div>
                </div>

                {{-- DELETE ACCOUNT --}}
                <div class="p-8 md:p-12 bg-red-50/30 rounded-2xl border border-dashed border-red-200">
                    <div class="max-w-xl text-red-600">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </x-user.app>
@endif