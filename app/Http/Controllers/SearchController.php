<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetPeoplesFormRequest;
use App\Http\Requests\GetPerfilRequest;
use App\User;
use App\Follower;
use App\Post;

class SearchController extends Controller
{
    public function getPeoples(GetPeoplesFormRequest $request, User $user)
    {
        $users = $user->searchPeoples($request->name);
        return response()->json($users);
    }

    public function getPerfil(GetPerfilRequest $request, User $user, Follower $follower, Post $post)
    {
        $user = $user->getUserByUsername($request->username);
        
        $data = [];

        if ($user) {
            $isFollowing = $follower->followerInstance($request->user->id, $user->id);

            $data['success'] = true;
            $data['user']    = $user;

            if ($isFollowing)
                $data['isfollowing'] = true;
            else
                $data['isfollowing'] = false;

            $data['stats'] = $follower->getStats($user->id);
            $data['posts'] = $post->countPostsByUserId($user->id);
            $data['ownperfil'] = $request->user->id == $user->id; 
                
        } else {
            $data['success'] = false;
        }

        return response()->json($data);
    }
}
