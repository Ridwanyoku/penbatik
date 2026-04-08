<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">

<div class="flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r flex flex-col z-10">
        <div class="h-20 flex items-center px-8">
            <h1 class="text-xl tracking-[0.2em] font-bold">PENBATIK</h1>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1">
            <a href="/dashboard" class="flex items-center gap-4 px-4 py-3 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-50 rounded-lg transition-all {{ request()->is('dashboard') ? 'bg-gray-100 text-black' : '' }}">
                <span class="text-lg">🏠</span> Dashboard
            </a>

            <a href="{{ route('products.index') }}" class="flex items-center gap-4 px-4 py-3 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-50 rounded-lg transition-all {{ request()->is('products*') ? 'bg-gray-100 text-black' : '' }}">
                <span class="text-lg">📦</span> Products
            </a>

            <a href="/transactions" class="flex items-center gap-4 px-4 py-3 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-100 rounded-lg transition-all">
                <span class="text-lg">💰</span> Transactions
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-50 rounded-lg transition-all">
                <span class="text-lg">📄</span> Reports
            </a>

            <a href="{{ route('staffs.index') }}" class="flex items-center gap-4 px-4 py-3 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-50 rounded-lg transition-all {{ request()->is('staffs*') ? 'bg-gray-100 text-black' : '' }}">
                <span class="text-lg">👥</span> Staffs
            </a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 bg-white">

        <header class="h-20 bg-white border-b flex items-center justify-end px-12">
            
            <div class="flex items-center gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 py-2 focus:outline-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-semibold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter mt-1">Administrator</p>
                            </div>
                            
                            <div class="w-10 h-10 rounded-full bg-gray-200 border border-gray-100 flex items-center justify-center text-gray-500 overflow-hidden shadow-sm group-hover:bg-gray-300 transition">
                                <span class="text-xl">👤</span>
                            </div>

                            <svg class="w-4 h-4 text-gray-400 group-hover:text-black transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b bg-gray-50/50">
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Signed in as</p>
                            <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-sm">
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-sm text-red-600">
                                {{ __('Sign Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto bg-[#FAFAFA] p-12">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>
</div>

</body>
</html>