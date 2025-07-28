<x-sampahgo-layout>
    <x-slot name="title">Dashboard</x-slot>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-primary">
                🏠 Dashboard SampahGo!
            </h2>
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}" wire:navigate>Home</a></li>
                    <li>Dashboard</li>
                </ul>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Welcome Card -->
        <div class="lg:col-span-2">
            <div class="card-sampahgo">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4">
                        Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->name }}! 👋
                    </h2>
                    <p class="text-base-content/70 mb-4">
                        Anda login sebagai <span class="badge badge-primary">{{ Auth::user()->peran ?? 'User' }}</span>
                    </p>
                    
                    @if(Auth::user()->rt_id)
                        <div class="alert alert-info">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Anda terdaftar di RT {{ Auth::user()->rt->nama ?? Auth::user()->rt_id }}</span>
                        </div>
                    @endif

                    <!-- Quick Actions based on Role -->
                    <div class="card-actions justify-end mt-6">
                        @if(Auth::user()->peran === 'RT')
                            <a href="#" wire:navigate class="btn btn-primary">
                                📝 Input Transaksi Baru
                            </a>
                        @elseif(Auth::user()->peran === 'FO')
                            <a href="#" wire:navigate class="btn btn-primary">
                                ✅ Review Transaksi
                            </a>
                        @elseif(in_array(Auth::user()->peran, ['SuperAdmin', 'RW']))
                            <a href="#" wire:navigate class="btn btn-primary">
                                📊 Lihat Laporan
                            </a>
                        @else
                            <a href="#" wire:navigate class="btn btn-primary">
                                📋 Lihat Riwayat
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="space-y-4">
            <!-- Status Card -->
            <div class="card bg-gradient-to-r from-primary to-secondary text-primary-content">
                <div class="card-body">
                    <h3 class="card-title text-lg">Status Sistem</h3>
                    <div class="flex items-center justify-between">
                        <span>Online</span>
                        <div class="badge badge-success">✓ Aktif</div>
                    </div>
                </div>
            </div>

            <!-- Role-specific Quick Stats -->
            @if(Auth::user()->peran === 'RT')
                <div class="stats stats-vertical shadow">
                    <div class="stat">
                        <div class="stat-title">Transaksi Bulan Ini</div>
                        <div class="stat-value text-primary">0</div>
                        <div class="stat-desc">Belum ada transaksi</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title">Total Pendapatan</div>
                        <div class="stat-value text-success">Rp 0</div>
                        <div class="stat-desc">Periode ini</div>
                    </div>
                </div>
            @elseif(Auth::user()->peran === 'FO')
                <div class="stats stats-vertical shadow">
                    <div class="stat">
                        <div class="stat-title">Pending Review</div>
                        <div class="stat-value text-warning">0</div>
                        <div class="stat-desc">Transaksi</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title">Approved Today</div>
                        <div class="stat-value text-success">0</div>
                        <div class="stat-desc">Transaksi</div>
                    </div>
                </div>
            @elseif(in_array(Auth::user()->peran, ['SuperAdmin', 'RW']))
                <div class="stats stats-vertical shadow">
                    <div class="stat">
                        <div class="stat-title">Total RT</div>
                        <div class="stat-value text-primary">{{ \App\Models\Rt::count() }}</div>
                        <div class="stat-desc">RT terdaftar</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title">Total Kategori</div>
                        <div class="stat-value text-secondary">{{ \App\Models\Kategori::count() }}</div>
                        <div class="stat-desc">Jenis sampah</div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-8">
        <div class="card-sampahgo">
            <div class="card-body">
                <h3 class="card-title text-xl mb-4">📈 Aktivitas Terbaru</h3>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Aktivitas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ now()->format('H:i') }}</td>
                                <td>Login ke sistem</td>
                                <td><span class="badge badge-success">Berhasil</span></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center text-base-content/50">
                                    Belum ada aktivitas lainnya
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-sampahgo-layout>
