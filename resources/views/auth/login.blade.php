<x-user.app>
    <div class="min-h-screen flex flex-col justify-center items-center bg-white">
        <div class="w-full max-w-[400px] p-10 bg-white border border-gray-200 rounded-xl shadow-sm">
            
            <h2 class="text-xl font-bold text-gray-900 mb-8 text-center">Login to Penbatik</h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 rounded-full border-gray-200 focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all"
                        placeholder="EMAIL">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 ml-2" />
                </div>

                <div class="mb-2">
                    <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-full border-gray-200 focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all"
                        placeholder="PASSWORD">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 ml-2" />
                </div>

                <div class="flex justify-end mb-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[11px] font-medium text-blue-400 hover:text-blue-500 transition">
                            Forgot?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#4A4A4A] hover:bg-black text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md active:scale-[0.98] mb-6">
                    Login
                </button>

                <p class="text-center text-[12px] text-gray-500 font-medium">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-500 font-bold">Register</a>
                </p>

                <div class="hidden">
                    <input id="remember_me" type="checkbox" name="remember" checked>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>