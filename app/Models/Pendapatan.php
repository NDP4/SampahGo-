<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'rt_id',
        'item_transaksi_id',
        'jumlah_uang',
    ];

    protected $casts = [
        'jumlah_uang' => 'decimal:2',
    ];

    /**
     * Get the RT that owns the pendapatan.
     */
    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class);
    }

    /**
     * Get the item transaksi that owns the pendapatan.
     */
    public function itemTransaksi(): BelongsTo
    {
        return $this->belongsTo(ItemTransaksi::class);
    }
}
