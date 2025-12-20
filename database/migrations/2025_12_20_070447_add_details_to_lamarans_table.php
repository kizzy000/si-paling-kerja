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
            $table->date('tanggal_lahir')->after('nama')->nullable();
            $table->string('alamat', 100)->after('tanggal_lahir');
            $table->string('email')->after('alamat')->unique();
            $table->string('no_telepon', 20)->after('jenis_kelamin');
            $table->string('kuliah', 50)->after('asal_sekolah');                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_lahir', 'alamat', 'email', 'no_telepon', 'kuliah']);
        });
    }
};
