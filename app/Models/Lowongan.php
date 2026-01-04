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

    // Scope untuk lowongan aktif
    public function scopeActive($query)
    {
        return $query->where('batas_waktu', '>=', now());
    }

    // Scope untuk search berdasarkan perusahaan
    public function scopeSearchPerusahaan($query, $search)
    {
        if ($search) {
            return $query->where('perusahaan', 'like', '%' . $search . '%');
        }
        return $query;
    }

    // Scope untuk search berdasarkan judul
    public function scopeSearchJudul($query, $judul)
    {
        if ($judul) {
            return $query->where('judul', 'like', '%' . $judul . '%');
        }
        return $query;
    }

    // Scope untuk sort berdasarkan tanggal
    public function scopeSortByDate($query, $sort)
    {
        if ($sort == 'terbaru') {
            return $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'terlama') {
            return $query->orderBy('created_at', 'asc');
        }
        return $query;
    }
}
