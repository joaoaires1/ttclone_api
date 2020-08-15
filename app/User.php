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
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Get user for test
     * @return User
     */
    public static function userForTest()
    {
        $test = self::whereEmail("usertest@test.com")->first();

        if ($test)
            return $test;

        return self::create([
            "name"         => "User Test",
            "username"     => "usertest",
            "email"        => "usertest@test.com",
            "password"     => Hash::make("qweqwe"),
            "avatar"       => "default.jpg"
        ]);
    }

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
