<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Accesor para la URL del avatar
    public function getAvatarAttribute($value)
    {
        return $value ? asset('storage/'.$value) : 'https://via.placeholder.com/150';
    }

    // Accesor para la URL del banner
    public function getBannerAttribute($value)
    {
        return $value ? asset('storage/'.$value) : null;
    }

    // Relación con posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relación con seguidores
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Relación con seguidos
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
}
