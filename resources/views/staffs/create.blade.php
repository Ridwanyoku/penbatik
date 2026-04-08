<x-app-layout>
    <div class="p-8 bg-white min-h-screen">
        <div class="max-w-xl mx-auto mb-10">
            <a href="{{ route('staffs.index') }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] hover:text-black transition flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to List
            </a>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Add New Staff</h1>
            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-[0.2em] font-medium">Create a new account for your team member</p>
        </div>

        <div class="max-w-xl mx-auto bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <form action="{{ route('staffs.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Full Name</label>
                    <input type="text" name="name" placeholder="Enter staff name" value="{{ old('name') }}" required
                        class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-[#FF3B3B] focus:border-[#FF3B3B] transition-all outline-none placeholder:text-gray-300 font-medium text-gray-700">
                    @error('name') <p class="text-[10px] text-red-500 mt-1 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" placeholder="staff@example.com" value="{{ old('email') }}" required
                        class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-[#FF3B3B] focus:border-[#FF3B3B] transition-all outline-none placeholder:text-gray-300 font-medium text-gray-700">
                    @error('email') <p class="text-[10px] text-red-500 mt-1 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 border-t border-gray-50">
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.2em] mb-4">Account Security</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Password</label>
                            <input type="password" name="password" placeholder="••••••••" required
                                class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-[#FF3B3B] focus:border-[#FF3B3B] transition-all outline-none placeholder:text-gray-300">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Confirm</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" required
                                class="w-full bg-gray-50 border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-[#FF3B3B] focus:border-[#FF3B3B] transition-all outline-none placeholder:text-gray-300">
                        </div>
                    </div>
                    @error('password') <p class="text-[10px] text-red-500 mt-2 font-bold uppercase tracking-wider">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-[#FF3B3B] text-white py-4 rounded-xl text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-red-600 transition-all shadow-md active:scale-[0.98]">
                        Save Staff Account
                    </button>
                    
                    <a href="{{ route('staffs.index') }}" 
                        class="block text-center mt-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest hover:text-gray-600 transition">
                        Discard & Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>