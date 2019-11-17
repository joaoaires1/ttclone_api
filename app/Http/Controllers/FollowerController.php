<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\DeleteFollowRequest;
use App\Follower;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly followership in storage.
     *
     * @param  StoreFollowRequest  $request
     * @return json
     */
    public function store(StoreFollowRequest $request)
    {
        $follow = Follower::create([
            'follower_id' => (int) $request->user->id,
            'followed_id' => (int) $request->followed_id 
        ]);

        return response()->json(["success" => true]);
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
     * @param  Request $request
     * @param  Follower $model
     * @return json
     */
    public function destroy($id, Request $request, Follower $model)
    {
        $response = array();
        $follower = $model->followerInstance($request->user->id, $id);

        if (isset($follower)) {
            $follower->delete();
            $response["success"] = true;
        } else {
            $response["success"] = false;
        }
        return response()->json($response);
    }
}
