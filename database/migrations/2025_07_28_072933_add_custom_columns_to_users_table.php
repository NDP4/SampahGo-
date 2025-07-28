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
        Schema::table('users', function (Blueprint $table) {
            // Custom columns from ERD
            $table->string('nama')->after('id');
            $table->string('kata_sandi')->after('nama');
            $table->enum('peran', ['SuperAdmin', 'RW', 'RT', 'FO', 'Warga'])->after('kata_sandi');
            $table->string('alamat')->nullable()->after('peran');
            $table->string('no_hp')->nullable()->after('alamat');
            
            // Foreign keys
            $table->foreignId('id_rw')->nullable()->constrained('rws')->after('no_hp');
            $table->foreignId('id_rt')->nullable()->constrained('rts')->after('id_rw');
            
            // Make default columns nullable since we use custom authentication
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_rw']);
            $table->dropForeign(['id_rt']);
            $table->dropColumn(['nama', 'kata_sandi', 'peran', 'alamat', 'no_hp', 'id_rw', 'id_rt']);
            
            // Restore original constraints
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
};
