<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="sampahgo_light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SampahGo!') }} - {{ $title ?? 'Sistem Manajemen Sampah' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased transition-theme">
        <div class="min-h-screen bg-base-200">
            
            <!-- Navigation -->
            @include('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-base-100 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Main Content -->
            <main class="flex-1">
                <div class="drawer">
                    <input id="drawer-toggle" type="checkbox" class="drawer-toggle" />
                    
                    <!-- Main Content Area -->
                    <div class="drawer-content">
                        <!-- Mobile Menu Button -->
                        <div class="navbar lg:hidden bg-base-100">
                            <div class="flex-none">
                                <label for="drawer-toggle" class="btn btn-square btn-ghost">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </label>
                            </div>
                            <div class="flex-1">
                                <h1 class="text-xl font-semibold">{{ $title ?? 'Dashboard' }}</h1>
                            </div>
                        </div>

                        <!-- Page Content -->
                        <div class="container mx-auto p-4">
                            {{ $slot }}
                        </div>
                    </div>

                    @auth
                        <!-- Sidebar for authenticated users -->
                        <div class="drawer-side">
                            <label for="drawer-toggle" class="drawer-overlay"></label>
                            <div class="sidebar-sampahgo min-h-full w-64 p-4">
                                
                                <!-- User Info -->
                                <div class="card bg-base-100 shadow-sm mb-4">
                                    <div class="card-body p-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="avatar">
                                                <div class="mask mask-circle w-12 h-12">
                                                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->nama ?? Auth::user()->name }}" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ Auth::user()->nama ?? Auth::user()->name }}</div>
                                                <div class="text-sm opacity-70">{{ Auth::user()->peran ?? 'User' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Menu Based on Role -->
                                <ul class="menu bg-base-100 rounded-box">
                                    <li class="menu-title">
                                        <span>Navigation</span>
                                    </li>
                                    
                                    <!-- Dashboard - All Users -->
                                    <li>
                                        <a href="{{ route('dashboard') }}" wire:navigate 
                                           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>

                                    @if(Auth::user()->peran === 'SuperAdmin')
                                        <!-- Super Admin Menu -->
                                        <li class="menu-title">
                                            <span>Super Admin</span>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                                </svg>
                                                Kelola RW
                                            </a>
                                        </li>
                                    @endif

                                    @if(in_array(Auth::user()->peran, ['SuperAdmin', 'RW']))
                                        <!-- RW Admin Menu -->
                                        <li class="menu-title">
                                            <span>RW Management</span>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Kategori Sampah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                                </svg>
                                                Kelola RT
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Laporan RW
                                            </a>
                                        </li>
                                    @endif

                                    @if(Auth::user()->peran === 'FO')
                                        <!-- Field Officer Menu -->
                                        <li class="menu-title">
                                            <span>Field Officer</span>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Approval Transaksi
                                            </a>
                                        </li>
                                    @endif

                                    @if(Auth::user()->peran === 'RT')
                                        <!-- RT Menu -->
                                        <li class="menu-title">
                                            <span>RT Management</span>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                                </svg>
                                                Input Transaksi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Rekap & Laporan
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Perbandingan RT
                                            </a>
                                        </li>
                                    @endif

                                    @if(Auth::user()->peran === 'Warga')
                                        <!-- Warga Menu -->
                                        <li class="menu-title">
                                            <span>Warga</span>
                                        </li>
                                        <li>
                                            <a href="#" wire:navigate>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Riwayat RT
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Common Menu Items -->
                                    <li class="menu-title">
                                        <span>Account</span>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.show') }}" wire:navigate 
                                           class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a href="{{ route('logout') }}" 
                                               @click.prevent="$root.submit();"
                                               class="text-error">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Logout
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer footer-center p-4 bg-base-300 text-base-content">
                <div>
                    <p>&copy; {{ date('Y') }} SampahGo! - Sistem Manajemen Sampah Terintegrasi</p>
                </div>
            </footer>
        </div>

        @stack('modals')

        @livewireScripts

        <!-- Wire Navigation Script -->
        <script>
            // Initialize Livewire Navigate
            document.addEventListener('livewire:navigated', () => {
                // Close mobile drawer after navigation
                const drawer = document.getElementById('drawer-toggle');
                if (drawer) {
                    drawer.checked = false;
                }
            });
        </script>
    </body>
</html>
