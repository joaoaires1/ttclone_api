<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'text'
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getPostsByUserId ($userId)
    {
        return self::where("user_id", $userId)
                ->with('user')
                ->get();
    }

    public function getPostById ($id)
    {
        return self::where('id', $id)
                ->with('user')
                ->first();
    }
}
