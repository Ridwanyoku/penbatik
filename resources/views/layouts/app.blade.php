<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-900">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-100 border-r flex flex-col">
        <!-- Logo -->
        <div class="p-6 border-b">
            <h1 class="text-lg tracking-widest font-semibold">PENBATIK</h1>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6 space-y-4 text-sm">

            <a href="/dashboard" class="flex items-center gap-3 text-gray-700 hover:text-black">
                🏠 <span>Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}" class="flex items-center gap-3 text-gray-700 hover:text-black">
                📦 <span>Products</span>
            </a>

            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-black">
                💳 <span>Transactions</span>
            </a>

            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-black">
                📊 <span>Reports</span>
            </a>

            <a href="{{ route('staffs.index') }}" class="flex items-center gap-3 text-gray-700 hover:text-black">
                👤 <span>Staffs</span>
            </a>

        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col bg-gray-100">

        <!-- TOPBAR -->
        <header class="h-16 bg-gray-100 border-b flex items-center justify-end px-6">

            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    
                    <!-- Trigger -->
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:text-black focus:outline-none">

                            <!-- Avatar -->
                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                👤
                            </div>

                            <!-- Nama -->
                            <span>{{ Auth::user()->name }}</span>

                            <!-- Icon dropdown -->
                            <svg class="fill-current h-4 w-4 ml-1" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                        </button>
                    </x-slot>

                    <!-- Dropdown Content -->
                    <x-slot name="content">

                        <div class="px-4 py-2 border-b">
                            <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div>
</div>

</body>
</html>