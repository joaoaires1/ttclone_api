<?php

namespace App\Http\Controllers\api\follow;

use App\Follower;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnfollowRequest;

class UnfollowController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  UnfollowRequest $request
     * @return json
     */
    public function destroy(UnfollowRequest $request, Follower $follow)
    {
        response()->json([
            'success' => $follow->deleteFollow($request)
        ]);
    }
}
