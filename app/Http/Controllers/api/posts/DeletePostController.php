<?php

namespace App\Http\Controllers\api\posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeletePostRequest;
use App\Post;

class DeletePostController extends Controller
{
    /**
     * @api {DELETE} /api/posts
     * @param DeletePostRequest $request
     * @param Post $post
     * @return json
     */
    public function destroy(DeletePostRequest $request, Post $post)
    {
        return response()->json([
            'success' => $request->post->delete()
        ]) ;
    }
}
