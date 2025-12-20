<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'gambar',
        'judul',
        'slug',
        'perusahaan',
        'posisi',
        'persyaratan',
        'batas_waktu',
        'user_id',
    ];

    // Kolom batas_waktu otomatis dikonversi menjadi objek Carbon (tanggal)
    protected $casts = [
        'batas_waktu' => 'datetime',
    ];

    //mengatur slug sebagai route key
    public function getRouteKeyName()
    {
        return 'slug';  
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi balik: Satu lowongan bisa punya banyak pendaftar
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }
}
