<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persetujuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_transaksi_id')->constrained('item_transaksis')->onDelete('cascade');
            $table->foreignId('disetujui_oleh')->constrained('users')->onDelete('cascade');
            $table->enum('tindakan', ['approve', 'reject', 'adjust']);
            $table->text('komentar')->nullable();
            $table->timestamp('pada_pukul');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persetujuans');
    }
};
