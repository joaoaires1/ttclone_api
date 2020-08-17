<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Follower;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
     * Register new user
     * @param object $request
     * @return User
     */
    public function userRegister($request)
    {
        return self::create([
            "name"         => $request->name,
            "username"     => $request->username,
            "email"        => $request->email,
            "password"     => Hash::make($request->password),
            "avatar"       => "default.jpg"
        ]);
    }

    /**
     * User sign in
     * @param object $request
     * @return User
     */
    public function userSignIn()
    {
        $this->access = $this->createToken('auth_token')->accessToken;
    }

    /**
     * Get all posts of an user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Search users by name or username
     * @param string $name
     * @return User
     */
    public function searchPeoples ($name)
    {
        return $this->where('name', 'like', "%$name%")
                    ->orWhere('username', 'like', "%$name%")
                    ->get();
    }

    /**
     * Set needed info for this perfil
     * @param GetPostsRequest $request
     * @return User
     */
    public function perfilInfo($request)
    {
        $user = $request->user();
        $this->own_perfil = $user->id == $this->id;
        $this->is_following = Follower::hasFollow($user->id, $this->id);
        $this->stats = Follower::getStats($this->id);
        return $this;
    }
}
