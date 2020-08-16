<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

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

    /**
     * Scope query for posts in timeline
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param int $userId
     * @return $query
     */
    public function scopeFollowing($query, $userId)
    {
        return $query->orWhereIn(
            'user_id', 
            Follower::where('follower_id', $userId)
                    ->pluck('followed_id')
        );
    }

    /**
     * Get posts for timeline or perfil
     * @param GetPostsRequest $request
     * @return Paginator
     */
    public function getPosts($request)
    {
        $posts = $this->where('user_id', $request->user->id)
                    ->orderBy('id', 'desc')
                    ->with('user');

        $currentPage = $request->page;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        if ($request->perfil_page)
            return $posts->paginate(15);
        
        return $posts
                ->following($request->user->id)
                ->paginate(15);
    }

    /**
     * Store new post
     * @param StorePostRequest $request
     * @return Post
     */
    public function storePost($request)
    {
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->text = $request->text;
        $post->save();
        
        return $post;
    }
}
