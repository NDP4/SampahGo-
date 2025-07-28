<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\User;
use App\Models\Kategori;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create RW
        $rw = Rw::create([
            'nama_rw' => 'RW 01',
            'alamat' => 'Jl. Contoh No. 1'
        ]);

        // Create RT
        $rt = Rt::create([
            'nama_rt' => 'RT 01',
            'alamat' => 'Jl. Contoh No. 1A',
            'id_rw' => $rw->id
        ]);

        // Create SuperAdmin
        User::create([
            'nama' => 'Super Admin',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'SuperAdmin',
            'alamat' => 'System Admin',
            'no_hp' => '081234567890'
        ]);

        // Create RW Admin
        User::create([
            'nama' => 'Admin RW 01',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'RW',
            'alamat' => 'Jl. Contoh No. 1',
            'no_hp' => '081234567891',
            'id_rw' => $rw->id
        ]);

        // Create RT Admin
        User::create([
            'nama' => 'Admin RT 01',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'RT',
            'alamat' => 'Jl. Contoh No. 1A',
            'no_hp' => '081234567892',
            'id_rw' => $rw->id,
            'id_rt' => $rt->id
        ]);

        // Create FO
        User::create([
            'nama' => 'Field Officer',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'FO',
            'alamat' => 'Jl. Contoh No. 2',
            'no_hp' => '081234567893',
            'id_rw' => $rw->id,
            'id_rt' => $rt->id
        ]);

        // Create Warga
        User::create([
            'nama' => 'Warga Test',
            'kata_sandi' => Hash::make('password'),
            'peran' => 'Warga',
            'alamat' => 'Jl. Contoh No. 3',
            'no_hp' => '081234567894',
            'id_rw' => $rw->id,
            'id_rt' => $rt->id
        ]);

        // Create sample categories
        Kategori::create([
            'nama_kategori' => 'Plastik',
            'harga_per_kg' => 2000
        ]);

        Kategori::create([
            'nama_kategori' => 'Kertas',
            'harga_per_kg' => 1500
        ]);

        Kategori::create([
            'nama_kategori' => 'Logam',
            'harga_per_kg' => 5000
        ]);
    }
}
