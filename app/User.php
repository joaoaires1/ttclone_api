<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Follower;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'avatar', 'api_token', 'api_token_expiry'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'api_token', 'api_token_expiry'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all posts of an user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function searchPeoples ($name)
    {
        return $this->where('name', 'like', "%$name%")
                    ->orWhere('username', 'like', "%$name%")
                    ->get();
    }

    public function getUserByUsername($username, $user = null)
    {
        $perfil = $this->where('username', $username)->first();

        if ($perfil) {
            $following = new Follower;
            $isFollowing = $following->followerInstance($user->id, $perfil->id);
            $perfil->is_following = $isFollowing ? true : false;
            $perfil->own_perfil = $perfil->id == $user->id;
        }
        

        return $perfil;
    }
}
