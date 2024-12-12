<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'jabatan', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the daily reports associated with the user.
     */
    // In Kpi.php model
    
    public function harian()
    {
        return $this->hasMany(Harian::class, 'id_marketing');
    }

    /**
     * Get the weekly reports associated with the user.
     */
    public function mingguan()
    {
        return $this->hasMany(Mingguan::class, 'id_marketing');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
