<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a pendaftar.
     */
    public function isPendaftar()
    {
        return $this->role === 'pendaftar';
    }

    /**
     * Check if the user is a perusahaan.
     */
    public function isPerusahaan()
    {
        return $this->role === 'perusahaan';
    }

    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }

    public function informasis()
    {
        return $this->hasMany(Informasi::class);
    }

    public function lowongans()
    {
        return $this->hasMany(Lowongan::class);
    }
}
