<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rt extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'rw_id',
    ];

    /**
     * Get the RW that owns the RT.
     */
    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class);
    }

    /**
     * Get the users for the RT.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the transaksis for the RT.
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    /**
     * Get the pendapatans for the RT.
     */
    public function pendapatans(): HasMany
    {
        return $this->hasMany(Pendapatan::class);
    }
}
