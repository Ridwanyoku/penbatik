<x-user.app>
    <div class="min-h-screen flex flex-col justify-center items-center bg-white py-12">
        <div class="w-full max-w-[450px] p-10 bg-white border border-gray-100 rounded-2xl shadow-sm">
            
            <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Create Account</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-8 text-center">Join the Penbatik Community</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Full Name</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                        placeholder="YOUR NAME">
                    <x-input-error :messages="$errors->get('name')" class="mt-1 ml-2" />
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Email Address</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                        placeholder="EMAIL@EXAMPLE.COM">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 ml-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <div>
                        <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                            placeholder="••••••••">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Confirm</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-5 py-3 rounded-full border-gray-100 bg-gray-50 focus:bg-white focus:border-black focus:ring-0 text-sm placeholder-gray-300 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                    <div class="col-span-2">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 ml-2" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ml-2" />
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#4A4A4A] hover:bg-black text-white font-bold py-4 rounded-xl text-[11px] uppercase tracking-[0.2em] transition-all shadow-md active:scale-[0.98] mb-6">
                    Create Account
                </button>

                <p class="text-center text-[12px] text-gray-500 font-medium">
                    Already registered? 
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-500 font-bold transition">Login</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>