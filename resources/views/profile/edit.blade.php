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