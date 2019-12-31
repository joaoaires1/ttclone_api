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
                ->orderBy('id', 'desc')
                ->get();
    }

    public function getPostById ($id)
    {
        return self::where('id', $id)
                ->with('user')
                ->first();
    }

    /**
     * Get posts to timeline
     * 
     * @param array $followedIds
     * @param int $userId
     * @return collection
     */
    public function getTimeLinePosts ($followedIds, $userId)
    {
        $posts = self::whereIn('user_id', $followedIds)
                        ->orWhere('user_id', $userId)
                        ->orderBy('id', 'desc')
                        ->with('user')
                        ->get();
                        
        return $posts;
    }

    public function countPostsByUserId($userId)
    {
        return self::where('user_id', $userId)->count();
    }
}
