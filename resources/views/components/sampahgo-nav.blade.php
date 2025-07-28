<div class="navbar bg-base-100 shadow-lg" wire:navigate>
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                @auth
                    @if(auth()->user()->peran === 'SuperAdmin')
                        <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a wire:navigate href="{{ route('admin.rw.index') }}">Kelola RW</a></li>
                        <li><a wire:navigate href="{{ route('admin.users.index') }}">Kelola Users</a></li>
                        <li><a wire:navigate href="{{ route('admin.reports.index') }}">Laporan Global</a></li>
                    @elseif(auth()->user()->peran === 'RW')
                        <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a wire:navigate href="{{ route('rw.rt.index') }}">Kelola RT</a></li>
                        <li><a wire:navigate href="{{ route('rw.categories.index') }}">Kategori Sampah</a></li>
                        <li><a wire:navigate href="{{ route('rw.transactions.index') }}">Transaksi</a></li>
                        <li><a wire:navigate href="{{ route('rw.reports.index') }}">Laporan RW</a></li>
                    @elseif(auth()->user()->peran === 'RT')
                        <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a wire:navigate href="{{ route('rt.transactions.index') }}">Input Transaksi</a></li>
                        <li><a wire:navigate href="{{ route('rt.reports.index') }}">Rekap & Nota</a></li>
                        <li><a wire:navigate href="{{ route('rt.comparison.index') }}">Perbandingan RT</a></li>
                    @elseif(auth()->user()->peran === 'FO')
                        <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a wire:navigate href="{{ route('fo.approvals.index') }}">Approval Transaksi</a></li>
                    @elseif(auth()->user()->peran === 'Warga')
                        <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a wire:navigate href="{{ route('warga.transactions.index') }}">Riwayat RT</a></li>
                        <li><a wire:navigate href="{{ route('warga.reports.index') }}">Download Rekap</a></li>
                    @endif
                @endauth
            </ul>
        </div>
        <a class="btn btn-ghost text-xl" wire:navigate href="{{ route('dashboard') }}">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4zM3 8a1 1 0 000 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a1 1 0 100-2H3zm8 7a1 1 0 11-2 0 1 1 0 012 0z"/>
                </svg>
                <span class="font-bold text-primary">SampahGo!</span>
            </div>
        </a>
    </div>
    
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            @auth
                @if(auth()->user()->peran === 'SuperAdmin')
                    <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>
                        <details>
                            <summary>Admin</summary>
                            <ul class="p-2 bg-base-100 rounded-t-none">
                                <li><a wire:navigate href="{{ route('admin.rw.index') }}">Kelola RW</a></li>
                                <li><a wire:navigate href="{{ route('admin.users.index') }}">Kelola Users</a></li>
                                <li><a wire:navigate href="{{ route('admin.reports.index') }}">Laporan Global</a></li>
                            </ul>
                        </details>
                    </li>
                @elseif(auth()->user()->peran === 'RW')
                    <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a wire:navigate href="{{ route('rw.rt.index') }}">Kelola RT</a></li>
                    <li><a wire:navigate href="{{ route('rw.categories.index') }}">Kategori</a></li>
                    <li><a wire:navigate href="{{ route('rw.transactions.index') }}">Transaksi</a></li>
                    <li><a wire:navigate href="{{ route('rw.reports.index') }}">Laporan</a></li>
                @elseif(auth()->user()->peran === 'RT')
                    <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a wire:navigate href="{{ route('rt.transactions.index') }}">Input Transaksi</a></li>
                    <li><a wire:navigate href="{{ route('rt.reports.index') }}">Rekap & Nota</a></li>
                    <li><a wire:navigate href="{{ route('rt.comparison.index') }}">Perbandingan</a></li>
                @elseif(auth()->user()->peran === 'FO')
                    <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a wire:navigate href="{{ route('fo.approvals.index') }}">Approval Transaksi</a></li>
                @elseif(auth()->user()->peran === 'Warga')
                    <li><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a wire:navigate href="{{ route('warga.transactions.index') }}">Riwayat RT</a></li>
                    <li><a wire:navigate href="{{ route('warga.reports.index') }}">Download Rekap</a></li>
                @endif
            @endauth
        </ul>
    </div>
    
    <div class="navbar-end">
        <!-- Theme Toggle -->
        <div class="dropdown dropdown-end mr-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
            </div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
                <li><a onclick="setTheme('light')">🌞 Light</a></li>
                <li><a onclick="setTheme('dark')">🌙 Dark</a></li>
                <li><a onclick="setTheme('auto')">🖥️ Auto</a></li>
            </ul>
        </div>

        @auth
            <!-- User Dropdown -->
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Profile" src="{{ Auth::user()->profile_photo_url }}" />
                    </div>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li class="menu-title">
                        <span>{{ Auth::user()->nama }}</span>
                        <span class="text-xs opacity-60">{{ Auth::user()->peran }}</span>
                    </li>
                    <li><a wire:navigate href="{{ route('profile.show') }}">Profile</a></li>
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <li><a wire:navigate href="{{ route('api-tokens.index') }}">API Tokens</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <div class="space-x-2">
                <a wire:navigate href="{{ route('login') }}" class="btn btn-ghost">Login</a>
                <a wire:navigate href="{{ route('register') }}" class="btn btn-primary">Register</a>
            </div>
        @endauth
    </div>
</div>

<script>
    function setTheme(theme) {
        if (theme === 'auto') {
            localStorage.removeItem('theme');
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-theme', 'dark');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                document.documentElement.classList.remove('dark');
            }
        } else {
            localStorage.setItem('theme', theme);
            document.documentElement.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }
</script>
