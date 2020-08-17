<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetPeoplesFormRequest;
use App\Http\Requests\GetPerfilRequest;
use App\Http\Resources\GetPeoplesResource;
use App\Http\Resources\PeoplesCollection;
use App\User;
use App\Follower;
use App\Post;

class SearchController extends Controller
{
    public function getPeoples(GetPeoplesFormRequest $request, User $user)
    {
        $users = $user->searchPeoples($request->name);
        return new GetPeoplesResource(['peoples' => PeoplesCollection::collection($users)]);
    }
}
