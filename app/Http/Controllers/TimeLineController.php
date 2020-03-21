<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\GetPostsResource;
use App\Http\Resources\PostResource;
use App\Follower;
use App\Post;

class TimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @param Follower $follower
     * @param Post $post
     * @return GetPostsResource
     */
    public function index(Request $request, Follower $follower, Post $post)
    {
        $userId      = $request->user->id;
        // Get followed users
        $followedIds = $follower->getFollowedUsers($userId);
        // Get timeline posts
        $posts       = $post->getTimeLinePosts ($followedIds, $userId);

        return new GetPostsResource(["posts" => PostResource::collection($posts)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
