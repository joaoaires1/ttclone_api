<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\StorePostResource;
use App\Http\Resources\GetPostsResource;

use App\Http\Requests\GetPerfilRequest;

use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @api {GET} /api/posts
     * @param  Request  $request
     * @param  Post     $model
     * @return GetPostsResource
     */
    public function index(Request $request, Post $model)
    {
        $posts = $model->getPostsByUserId($request->user->id);

        return new GetPostsResource(["posts" => $posts]);
    }

    /**
     * Store a newly post.
     *
     * @api {POST} /api/posts
     * @param  StorePostRequest  $request
     * @return StorePostResource
     */
    public function store(StorePostRequest $request, Post $model)
    {
        $userId = $request->user->id;
        
        $post = Post::create([
            "user_id" => $userId,
            "text"    => $request->text
        ]);

        return new StorePostResource($model->with('user')->find($post->id));
    }

    /**
     * Display the specified resource.
     *
     * @api {GET} /api/posts/{id}
     * @param  int  $id
     * @param  Post $model
     * @return GetPostsResource
     */
    public function show($id, Post $model)
    {
        $post = $model->getPostById($id);

        return new GetPostsResource(["posts" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @api {PUT} /api/posts/{id}
     * @param  StorePostRequest  $request
     * @param  int  $id
     * @param  Post $model
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id, Post $model)
    {
        $post = $model->getPostById($id);
        $post->text = $request->text;
        $post->save();

        return new GetPostsResource(["posts" => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Post $model
     * @return json
     */
    public function destroy($id, Post $model)
    {
        $response = array();
        $post     = $model->getPostById($id);

        if ( isset($post) ) {
            $post->delete();
            $response["success"] = true;
        } else {
            $response["success"] = false;
        }
            
        return response()->json($response);
    }

    public function getPostsByUsername(GetPerfilRequest $request, Post $post, User $user)
    {
        $user = $user->getUserByUsername($request->username);

        if ( $user ) {
            $post = $post->getPostsByUserId($user->id);
            return new GetPostsResource(["posts" => $post]);
        } else {
            return response()->json(['success' => false]);
        }
        
    }
}
