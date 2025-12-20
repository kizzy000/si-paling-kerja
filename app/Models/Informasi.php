<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasis';

    protected $fillable = [
        'judul',
        'slug',
        'excerpt',
        'deskripsi',
        'file',
        'user_id',
    ];

    //slug sebagai route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi ke User (pembuat informasi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
