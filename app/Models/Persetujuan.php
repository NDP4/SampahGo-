<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Persetujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_transaksi_id',
        'disetujui_oleh',
        'tindakan',
        'komentar',
        'pada_pukul',
    ];

    protected $casts = [
        'pada_pukul' => 'datetime',
    ];

    /**
     * Get the item transaksi that owns the persetujuan.
     */
    public function itemTransaksi(): BelongsTo
    {
        return $this->belongsTo(ItemTransaksi::class);
    }

    /**
     * Get the user who approved the item transaksi.
     */
    public function penyetuju(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}
