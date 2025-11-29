<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apartemen Sejahtera') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <div class="flex items-center gap-2 text-[#A8E6CF] font-bold text-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-gray-800">Realty</span>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                
                <a href="{{ url('/') }}" class="flex items-center px-4 py-3 mb-4 text-white bg-[#74A88E] rounded-lg hover:bg-[#5e8f76] transition-colors shadow-sm font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    Lihat Website Depan
                </a>

                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                @if(Auth::user()->isAdmin())
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</p>
                </div>

                <a href="{{ route('admin.units.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.units.*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Unit Apartemen
                </a>

                <a href="{{ route('admin.residents.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.residents.*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Data Penghuni
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Keuangan & Layanan</p>
                </div>

                <a href="{{ route('admin.bills.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.bills.*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Tagihan
                </a>

                <a href="{{ route('admin.complaints.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.complaints.*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Laporan Masuk
                </a>
                @endif

                @if(!Auth::user()->isAdmin())
                <a href="{{ route('resident.bills.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('resident.bills.*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    💳 Tagihan Saya
                </a>
                <a href="{{ route('resident.complaints.index') }}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('resident.complaints.*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : '' }}">
                    🔧 Lapor Kerusakan
                </a>
                @endif

            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-600" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="container mx-auto px-6 py-8">
                @if (isset($header))
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $header }}</h2>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>