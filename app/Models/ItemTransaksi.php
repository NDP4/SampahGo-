<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'kategori_id',
        'berat_input',
        'berat_disetujui',
        'harga_total',
    ];

    protected $casts = [
        'berat_input' => 'decimal:2',
        'berat_disetujui' => 'decimal:2',
        'harga_total' => 'decimal:2',
    ];

    /**
     * Get the transaksi that owns the item transaksi.
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    /**
     * Get the kategori that owns the item transaksi.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Get the persetujuans for the item transaksi.
     */
    public function persetujuans(): HasMany
    {
        return $this->hasMany(Persetujuan::class);
    }

    /**
     * Get the pendapatans for the item transaksi.
     */
    public function pendapatans(): HasMany
    {
        return $this->hasMany(Pendapatan::class);
    }
}
