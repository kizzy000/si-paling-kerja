<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
