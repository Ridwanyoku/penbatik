<x-user.app>
    <div class="min-h-screen flex flex-col justify-center items-center bg-white p-6">
        <div class="w-full max-w-[450px] p-10 bg-white border border-gray-100 rounded-2xl shadow-sm text-center">
            
            <div class="mb-6 flex justify-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-900 mb-4">Verify Your Email</h2>
            
            <div class="mb-8 text-[11px] text-gray-500 leading-relaxed uppercase tracking-widest font-medium">
                {{ __('Thanks for signing up! Please verify your email address by clicking the link we just sent to you. Didn\'t receive it? We\'ll send another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-bold text-[10px] text-green-500 uppercase tracking-widest bg-green-50 py-2 rounded-lg">
                    {{ __('A new link has been sent to your email.') }}
                </div>
            @endif

            <div class="flex flex-col gap-4 items-center">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-black text-white py-4 rounded-xl text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-md">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-[#FF3B3B] transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-user.app>