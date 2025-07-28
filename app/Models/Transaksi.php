<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'rt_id',
        'rw_id',
        'dibuat_oleh',
        'status',
    ];

    /**
     * Get the RT that owns the transaksi.
     */
    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class);
    }

    /**
     * Get the RW that owns the transaksi.
     */
    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class);
    }

    /**
     * Get the user who created the transaksi.
     */
    public function pembuatTransaksi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    /**
     * Get the item transaksis for the transaksi.
     */
    public function itemTransaksis(): HasMany
    {
        return $this->hasMany(ItemTransaksi::class);
    }
}
