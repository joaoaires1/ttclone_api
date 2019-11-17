<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'follower_id', 'followed_id'
    ];

    /**
     * Check if followership exists
     * 
     * @return boolean
     */
    public static function alreadyFollowed ($followerId, $followedId) 
    {
        return (bool) self::where("follower_id", $followerId)
                ->where("followed_id", $followedId)
                ->count();
    }

    /**
     * Instaciate a followership object
     * 
     * @return collection
     */
    public function followerInstance ($followerId, $followedId)
    {
        return self::where("follower_id", $followerId)
                ->where("followed_id", $followedId)
                ->first();
    }
}
