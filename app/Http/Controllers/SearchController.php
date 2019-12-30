<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetPeoplesFormRequest;
use App\Http\Requests\GetPerfilRequest;
use App\User;

class SearchController extends Controller
{
    public function getPeoples(GetPeoplesFormRequest $request, User $user)
    {
        $users = $user->searchPeoples($request->name);
        return response()->json($users);
    }

    public function getPerfil(GetPerfilRequest $request, User $user)
    {
        $user = $user->getUserByUsername($request->username);
        
        $data = [];

        if ($user) {
            $data['success'] = true;
            $data['user']    = $user;
        } else {
            $data['success'] = false;
        }

        return response()->json($data);
    }
}
