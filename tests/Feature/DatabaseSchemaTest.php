<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\ItemTransaksi;
use App\Models\Persetujuan;
use App\Models\Pendapatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DatabaseSchemaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_rw_and_rt_relationship()
    {
        $rw = Rw::factory()->create(['nama' => 'RW 01']);
        $rt = Rt::factory()->create(['nama' => 'RT 01', 'rw_id' => $rw->id]);

        $this->assertDatabaseHas('rws', ['nama' => 'RW 01']);
        $this->assertDatabaseHas('rts', ['nama' => 'RT 01', 'rw_id' => $rw->id]);
        $this->assertEquals('RW 01', $rt->rw->nama);
    }

    #[Test]
    public function it_can_create_user_with_roles()
    {
        $rw = Rw::factory()->create();
        $rt = Rt::factory()->create(['rw_id' => $rw->id]);

        $user = User::factory()
            ->withRole('Warga')
            ->withRtRw($rt->id, $rw->id)
            ->create([
                'nama' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $this->assertDatabaseHas('users', [
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'peran' => 'Warga',
            'aktif' => true,
        ]);
    }

    #[Test]
    public function it_can_create_kategori()
    {
        $kategori = Kategori::create([
            'nama' => 'Plastik',
            'deskripsi' => 'Sampah plastik daur ulang',
            'harga_per_kg' => 2500.00,
        ]);

        $this->assertDatabaseHas('kategoris', [
            'nama' => 'Plastik',
            'harga_per_kg' => 2500.00,
        ]);
    }

    #[Test]
    public function it_can_create_complete_transaction_flow()
    {
        // Setup basic data
        $rw = Rw::factory()->create();
        $rt = Rt::factory()->create(['rw_id' => $rw->id]);
        $user = User::factory()
            ->withRole('FO')
            ->withRtRw($rt->id, $rw->id)
            ->create();
        $kategori = Kategori::create([
            'nama' => 'Plastik',
            'deskripsi' => 'Sampah plastik',
            'harga_per_kg' => 2500.00,
        ]);

        // Create transaction
        $transaksi = Transaksi::create([
            'rt_id' => $rt->id,
            'rw_id' => $rw->id,
            'dibuat_oleh' => $user->id,
            'status' => 'pending',
        ]);

        // Create item transaction
        $itemTransaksi = ItemTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'kategori_id' => $kategori->id,
            'berat_input' => 5.50,
            'berat_disetujui' => null,
            'harga_total' => null,
        ]);

        // Create approval
        $persetujuan = Persetujuan::create([
            'item_transaksi_id' => $itemTransaksi->id,
            'disetujui_oleh' => $user->id,
            'tindakan' => 'approve',
            'komentar' => 'Disetujui',
            'pada_pukul' => now(),
        ]);

        // Update item with approved weight and calculate total
        $itemTransaksi->update([
            'berat_disetujui' => 5.00,
            'harga_total' => 5.00 * 2500.00,
        ]);

        // Create income
        $pendapatan = Pendapatan::create([
            'rt_id' => $rt->id,
            'item_transaksi_id' => $itemTransaksi->id,
            'jumlah_uang' => 12500.00,
        ]);

        // Verify all relationships work
        $this->assertEquals($transaksi->id, $itemTransaksi->transaksi->id);
        $this->assertEquals($kategori->id, $itemTransaksi->kategori->id);
        $this->assertEquals($itemTransaksi->id, $persetujuan->itemTransaksi->id);
        $this->assertEquals($itemTransaksi->id, $pendapatan->itemTransaksi->id);
        $this->assertEquals($rt->id, $pendapatan->rt->id);
    }

    #[Test]
    public function it_validates_enum_values()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $rw = Rw::factory()->create();
        $rt = Rt::factory()->create(['rw_id' => $rw->id]);

        // Try to create user with invalid role
        User::factory()
            ->withRole('InvalidRole')
            ->withRtRw($rt->id, $rw->id)
            ->create();
    }
}
