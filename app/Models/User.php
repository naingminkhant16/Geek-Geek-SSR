<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',  'username',
        'email', 'password', 'profile',
        'bio', 'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        return $this->hasManyThrough(User::class, Follower::class, 'user_id', 'id', 'id', 'follower_id');
    }

    public function followings()
    {
        return $this->hasManyThrough(User::class, Follower::class, 'follower_id', 'id', 'id', 'user_id');
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::slug(uniqid($value . "-")),
        );
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => boolval($value),
        );
    }
}
