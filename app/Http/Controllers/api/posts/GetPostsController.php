<?php

namespace App\Http\Controllers\api\posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetPostsRequest;
use App\Http\Resources\GetPostsResource;
use App\Http\Resources\PostResource;
use App\Post;

class GetPostsController extends Controller
{
    /**
     * @api {GET} /api/posts
     * Get posts in timeline or perfil page
     * @param GetPostsRequest $request
     * @param Post $post
     * @return GetPostsResource
     */
    public function index(GetPostsRequest $request, Post $post)
    {
        $posts = $post->getPosts($request)->toArray();
        $user  =  $request->user->perfilInfo($request);
        
        return new GetPostsResource([
            'posts' => PostResource::collection($posts['data']),
            'total_posts' => $posts['total'],
            'user'  => $user
        ]);
    }
}
