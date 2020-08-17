<?php

namespace App\Http\Controllers\api\follow;

use App\Follower;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFollowRequest;

class FollowController extends Controller
{
    /**
     * @api {POST} /api/follow
     * @param StoreFollowRequest $request
     * @return json
     */
    public function store(StoreFollowRequest $request, Follower $follow)
    {
        return response()->json([
            "success" => $follow->storeFollow($request)
        ]);
    }
}
