<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetPeoplesFormRequest;
use App\User;

class SearchController extends Controller
{
    public function getPeoples(GetPeoplesFormRequest $request, User $user)
    {
        $users = $user->searchPeoples($request->name);
        return response()->json($users);
    }
}
