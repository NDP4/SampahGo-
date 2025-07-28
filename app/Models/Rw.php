<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rw extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_rw',
        'alamat',
    ];

    /**
     * Get the RTs for the RW.
     */
    public function rts(): HasMany
    {
        return $this->hasMany(Rt::class, 'id_rw');
    }

    /**
     * Get the users for the RW.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_rw');
    }

    /**
     * Get the transaksis for the RW.
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
