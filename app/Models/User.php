<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'fecha_nacimiento',
        'password',
        'fecha_registro',
        'rol',
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
            'fecha_registro' => 'datetime',
        ];
    }

    /**
     * Boot function to set default values.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->fecha_registro = now();
            $user->rol = $user->rol ?? 'user';
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
