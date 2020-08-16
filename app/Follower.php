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
        return (boolean) self::where("follower_id", $followerId)
                ->where("followed_id", $followedId)
                ->count();
    }

    /**
     * Check if an user follow other user
     * 
     * @return collection
     */
    public static function hasFollow ($followerId, $followedId)
    {
        return (boolean) self::where("follower_id", $followerId)
                ->where("followed_id", $followedId)
                ->count();
    }

    /**
     * Return an array with ids at this user follows
     * 
     * @return array
     */
    public function getFollowedUsers ($userId)
    {
        $followedIds = array();
        
        $followed = self::where("follower_id", $userId)
                    ->select("followed_id")
                    ->get();

        foreach ($followed as $follow) {
            array_push($followedIds, $follow->followed_id);
        }

        return $followedIds;
    }

    public function getStats($userId)
    {
        $isFollowing = self::where('follower_id', $userId)->count();
        $wasFollowed = self::where('followed_id', $userId)->count();

        return [
            "is_following" => $isFollowing,
            "was_followed" => $wasFollowed
        ];
    }

    /**
     * Store new follow
     * @param StoreFollowRequest $request
     * @return boolean
     */
    public function storeFollow($request)
    {
        $follow = Follower::create([
            'follower_id' => (int) $request->user->id,
            'followed_id' => (int) $request->followed_id 
        ]);

        return $follow ? true : false;
    }

    /**
     * Delete an follow register
     * @param UnfollowRequest
     * @return boolean
     */
    public function deleteFollow($request)
    {
        return self::where('follower_id', $request->user->id)
                    ->Where('followed_id', $request->followed_id)
                    ->delete();
    }
}
