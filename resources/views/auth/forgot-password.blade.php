<x-user.app>
    <div class="min-h-screen flex flex-col justify-center items-center bg-white p-6">
        <div class="w-full max-w-[400px] p-10 bg-white border border-gray-100 rounded-2xl shadow-sm">
            
            <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Reset Password</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-8 text-center leading-relaxed">
                {{ __('Enter your email to receive a reset link.') }}
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-8">
                    <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                        placeholder="YOUR@EMAIL.COM">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all shadow-md active:scale-95">
                    {{ __('Email Reset Link') }}
                </button>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-black transition">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-user.app>