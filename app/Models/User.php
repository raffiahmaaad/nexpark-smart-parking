<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'email',
        'password',
        'avatar',
        'gender',
        'is_admin',
    ];

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

    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->avatar && !$user->is_admin) {
                $fontPath = public_path('fonts/Oliciy.ttf');
                $char = strtoupper(substr($user->name ?? '', 0, 1));
                $user->avatar = makeAvatar($fontPath, 'users/avatars/' . rand() . '_avatar.png', $char);
            }
        });
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return asset('backend/default-avatar.png');
    }

    public function getIsAdminAttribute()
    {
        return (bool) ($this->attributes['is_admin'] ?? false);
    }
}



