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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rt_id')->constrained('rts')->onDelete('cascade');
            $table->foreignId('rw_id')->constrained('rws')->onDelete('cascade');
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected', 'adjusted']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
