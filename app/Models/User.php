<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'chain',
        'role',
    ];

    // Dalam model User
    public function isAdminYearSet()
    {
        return !is_null($this->tahun);
    }

    public function getAdminDefaultYear()
    {
        return $this->tahun; // Sesuaikan dengan nama kolom yang sesuai pada tabel database
    }

    // Di dalam model User
    public function getAdminYear()
    {
        return $this->role === 'Admin' ? $this->getAdminDefaultYear() : null;
    }
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->role == 'Admin'; // Sesuaikan dengan struktur peran Anda
    }

    // Di dalam model User
    public function home()
    {
        return $this->hasOne(Home::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->translatedFormat('l, d F Y H:i:s');
    }
}
