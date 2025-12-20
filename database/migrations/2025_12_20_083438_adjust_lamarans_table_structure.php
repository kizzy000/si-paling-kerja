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
        Schema::table('lamarans', function (Blueprint $table) {
            $table->dropColumn(['nama', 'email']);
            $table->unique(['user_id', 'lowongan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            $table->string('nama')->after('kode_pendaftaran');
            $table->string('email')->after('alamat')->unique();
            $table->dropUnique(['user_id', 'lowongan_id']);
        });
    }
};
