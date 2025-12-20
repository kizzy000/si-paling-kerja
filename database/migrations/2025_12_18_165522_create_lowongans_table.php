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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('gambar'); // varchar(255)
            $table->string('judul'); // varchar(255)
            $table->string('slug'); // varchar(255)
            $table->string('perusahaan'); // varchar(255)
            $table->string('posisi'); // varchar(255)
            $table->text('persyaratan'); // text
            $table->dateTime('batas_waktu'); // datetime
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // bigint(20)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
