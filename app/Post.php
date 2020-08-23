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
        $post->user_id = $request->user->id;
        $post->text = $request->text;
        $post->save();
        
        return $post;
    }

    /**
     * Delete a post
     * @param int $postId
     * @return boolean
     */
    public function deletePost($postId)
    {
        return (boolean) self::find($postId)->delete();
    }
}
