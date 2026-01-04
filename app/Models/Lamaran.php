<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Lamaran extends Model
{
    protected $fillable = [
        'kode_pendaftaran',
        'tanggal_lahir',
        'alamat',
        'jurusan',
        'asal_sekolah',
        'kuliah',
        'jenis_kelamin',
        'no_telepon',
        'user_id',
        'lowongan_id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['jenis_kelamin'] ?? false, function ($query, $jenis_kelamin) {
            return $query->where('jenis_kelamin', $jenis_kelamin);
        });
    }

    //slug sebagai route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
