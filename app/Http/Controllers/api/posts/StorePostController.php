<?php

namespace App\Http\Controllers\api\posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\StorePostResource;
use App\Post;

class StorePostController extends Controller
{
    public function store(StorePostRequest $request, Post $post)
    {
        return new StorePostResource([
            'post' => $post->storePost($request),
            'user' => $request->user
        ]);
    }
}
