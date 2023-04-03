<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Favorite;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'account_type',
        'email',
        'password',
        'hometown',
        'introduction',
        'photo_url',
        'birthday',
        'instagram',
        'facebook',
        'snapchat',
        'twitter',
        'tiktok',
        'linkedin',
        'github',
        'discord',
        'youtube',
        'team_name',
        'slug'
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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }

    public function hasRole($role) {
        foreach($this->roles as $val) {
            if($val->name==$role) {
                return true;
            }
        }
        return false;
    }
}
