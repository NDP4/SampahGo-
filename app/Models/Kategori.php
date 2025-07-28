<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga_per_kg',
    ];

    protected $casts = [
        'harga_per_kg' => 'decimal:2',
    ];

    /**
     * Get the item transaksis for the kategori.
     */
    public function itemTransaksis(): HasMany
    {
        return $this->hasMany(ItemTransaksi::class);
    }
}
