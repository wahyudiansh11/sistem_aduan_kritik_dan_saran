<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Dinkes Sumenep</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        :root {
            --sidebar-width: 280px;
            --primary-dinkes: #0f5a43;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: true }">
    
    <aside 
        class="fixed top-0 left-0 z-40 h-screen transition-transform border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        style="width: var(--sidebar-width);"
    >
        <div class="h-full px-3 py-4 overflow-y-auto flex flex-col">
            <div class="flex items-center ps-2.5 mb-8 mt-2">
                <img src="{{ asset('images/logo-sumenep.png') }}" class="h-10 me-3" alt="Logo Sumenep" />
                <div>
                    <span class="block text-sm font-bold uppercase tracking-wider text-emerald-900 dark:text-white">Dinkes</span>
                    <span class="block text-xs text-gray-500 uppercase">Sumenep</span>
                </div>
            </div>

            <ul class="space-y-2 font-medium flex-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-xl dark:text-white hover:bg-emerald-50 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-lg shadow-emerald-200' : '' }}">
                        <i class="bi bi-grid-fill w-5 h-5 transition duration-75"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                
                <div class="pt-4 pb-2 text-[10px] font-bold uppercase text-gray-400 tracking-widest ps-4">Layanan Aduan</div>

                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-xl dark:text-white hover:bg-emerald-50 dark:hover:bg-gray-700 group">
                        <i class="bi bi-inbox-fill w-5 h-5"></i>
                        <span class="ms-3 flex-1">Semua Aduan</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-emerald-800 bg-emerald-100 rounded-full">3</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-xl dark:text-white hover:bg-emerald-50 dark:hover:bg-gray-700 group">
                        <i class="bi bi-exclamation-octagon-fill text-red-500"></i>
                        <span class="ms-3">Darurat / Ambulans</span>
                    </a>
                </li>

                <div class="pt-4 pb-2 text-[10px] font-bold uppercase text-gray-400 tracking-widest ps-4">Sistem</div>

                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-xl dark:text-white hover:bg-emerald-50 dark:hover:bg-gray-700 group">
                        <i class="bi bi-people-fill w-5 h-5"></i>
                        <span class="ms-3">Manajemen User</span>
                    </a>
                </li>
            </ul>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center p-2 mb-2">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ms-3 overflow-hidden">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 text-red-600 rounded-xl hover:bg-red-50 transition-colors">
                        <i class="bi bi-box-arrow-left w-5 h-5"></i>
                        <span class="ms-3 text-sm font-bold">Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div 
        class="transition-all duration-300"
        :class="sidebarOpen ? 'lg:ml-[280px]' : 'ml-0'"
    >
        <nav class="sticky top-0 z-30 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 lg:px-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none">
                            <i class="bi bi-list text-2xl"></i>
                        </button>
                        <div class="ms-4 hidden md:block">
                            <h2 class="text-sm font-medium text-gray-500">Selamat datang di Panel Admin</h2>
                            <p class="text-xs text-gray-400">{{ now()->format('l, d F Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <button class="p-2 text-gray-400 hover:text-emerald-600 transition-colors">
                            <i class="bi bi-bell text-xl"></i>
                        </button>
                        <div class="h-8 w-[1px] bg-gray-200 mx-2"></div>
                        <a href="" class="text-sm font-medium text-gray-700 hover:text-emerald-600">
                             Profil <i class="bi bi-person-circle ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        @isset($header)
            <header class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        <main class="p-4 lg:p-8">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>