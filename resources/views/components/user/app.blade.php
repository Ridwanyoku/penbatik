<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Penbatik' }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .logo-font { font-family: 'Cormorant Garamond', serif; }
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen" x-data="{ mobileMenuOpen: false }">

    <header class="w-full bg-white border-b border-gray-100 py-4 lg:py-6 px-6 lg:px-10 flex items-center justify-between sticky top-0 z-50">
        
        <nav class="hidden lg:flex flex-1 items-center gap-8 text-[11px] tracking-[0.2em] font-medium text-gray-500">
            <a href="/" class="hover:text-black transition-colors uppercase font-bold">All</a>
            <a href="/about" class="hover:text-black transition-colors uppercase font-bold">About Us</a>
            <a href="/customer-care" class="hover:text-black transition-colors uppercase font-bold whitespace-nowrap">Customer Care</a>
        </nav>

        <div class="flex lg:hidden flex-1">
            <button @click="mobileMenuOpen = true" class="text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="flex-none text-center">
            <a href="/" class="logo-font text-2xl lg:text-3xl tracking-[0.2em] lg:tracking-[0.4em] font-bold uppercase text-black italic">
                PENBATIK
            </a>
        </div>

        <div class="flex-1 flex items-center justify-end gap-4 lg:gap-6 text-gray-600">
            <button class="hover:text-black hidden sm:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </button>
            <a href="/cart" class="hover:text-black relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            </a>
            @auth
                <a href="{{ route('profile.edit') }}" class="hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-[10px] lg:text-[11px] tracking-widest uppercase font-bold hover:text-black transition-colors">Login</a>
            @endauth
        </div>
    </header>

    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         x-cloak
         class="fixed inset-0 z-[60] bg-white p-8 flex flex-col">
        
        <div class="flex justify-end mb-12">
            <button @click="mobileMenuOpen = false" class="text-gray-400 uppercase text-[10px] tracking-widest font-bold flex items-center gap-2">
                Close 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <nav class="flex flex-col gap-8 text-xl font-bold uppercase tracking-[0.2em]">
            <a href="/" @click="mobileMenuOpen = false">All</a>
            <a href="/about" @click="mobileMenuOpen = false">About Us</a>
            <a href="/customer-care" @click="mobileMenuOpen = false">Customer Care</a>
            <hr class="border-gray-100">
            <button class="text-left text-sm text-gray-400">Search</button>
        </nav>
    </div>

    <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" x-cloak class="fixed inset-0 bg-black/20 z-[55]"></div>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-[#0a0a0a] text-white py-12 lg:py-16 px-6 lg:px-12 mt-20">
        <div class="max-w-7xl mx-auto">
            <h2 class="logo-font text-2xl lg:text-3xl tracking-[0.3em] font-bold uppercase italic mb-10 lg:mb-12">PENBATIK</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-12">
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-widest mb-4 text-gray-500">Company</h4>
                    <p class="text-sm text-gray-400 leading-relaxed font-light">
                        PT Ficti Vashion<br>
                        Cipayung Box Blok 9, Depok. 19458<br>
                        <span class="text-gray-600 mt-2 block">+62 876 6789 9876</span>
                    </p>
                </div>
                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-widest mb-4 text-gray-500">Connect</h4>
                    <div class="flex gap-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                        <a href="#" class="hover:text-white transition-colors">Twitter</a>
                        <a href="#" class="hover:text-white transition-colors">Instagram</a>
                        <a href="#" class="hover:text-white transition-colors">Facebook</a>
                    </div>
                </div>
            </div>
            <div class="mt-16 pt-8 border-t border-white/5 text-[9px] text-gray-600 uppercase tracking-[0.2em] flex justify-between">
                <span>© 2026 Penbatik.</span>
                <span class="hidden sm:inline text-gray-800 italic">Crafted for Excellence</span>
            </div>
        </div>
    </footer>

</body>
</html>