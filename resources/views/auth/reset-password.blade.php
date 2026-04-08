<x-user.app>
    <div class="min-h-screen flex flex-col justify-center items-center bg-white p-6">
        <div class="w-full max-w-[450px] p-10 bg-white border border-gray-100 rounded-2xl shadow-sm">
            
            <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Set New Password</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-8 text-center">Update your account credentials</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-5">
                    <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                        class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                        placeholder="YOUR@EMAIL.COM">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 ml-2" />
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">New Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 ml-2" />
                </div>

                <div class="mb-8">
                    <label for="password_confirmation" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ml-2" />
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded-xl text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-md active:scale-95">
                    {{ __('Update Password') }}
                </button>
            </form>
        </div>
    </div>
</x-user.app>