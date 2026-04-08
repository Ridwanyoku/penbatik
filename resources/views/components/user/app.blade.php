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
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    <header class="w-full bg-white border-b border-gray-100 py-6 px-10 flex items-center justify-between sticky top-0 z-50">
        <div class="flex-1 flex items-center gap-8 text-[11px] tracking-[0.2em] font-medium text-gray-500">
            <a href="/" class="hover:text-black transition-colors uppercase font-bold">All</a>
            <a href="#" class="hover:text-black transition-colors uppercase font-bold">About Us</a>
            <a href="#" class="hover:text-black transition-colors uppercase font-bold whitespace-nowrap">Customer Care</a>
        </div>

        <div class="flex-none text-center">
            <a href="/" class="logo-font text-3xl tracking-[0.4em] font-bold uppercase text-black italic">
                P E N B A T I K
            </a>
        </div>

        <div class="flex-1 flex items-center justify-end gap-6 text-gray-600">
            <button class="hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </button>
            <a href="/cart" class="hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            </a>
            @auth
                <a href="{{ route('profile.edit') }}" class="hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-[11px] tracking-widest uppercase font-bold hover:text-black transition-colors">Login</a>
            @endauth
        </div>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-[#0a0a0a] text-white py-16 px-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="logo-font text-3xl tracking-[0.3em] font-bold uppercase italic mb-12">P E N B A T I K</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-4">Company</h4>
                    <p class="text-sm text-gray-400">PT Ficti Vashion<br>Cipayung Box Blok 9, Depok. 19458<br>+62 876 6789 9876</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest mb-4">Media Socials</h4>
                    <div class="flex gap-4 text-gray-400">
                        <span>Twitter</span> <span>IG</span> <span>FB</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>