<?php

namespace App\Http\Controllers\api\perfil;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetPeoplesFormRequest;
use App\Http\Resources\GetPeoplesResource;
use App\Http\Resources\PeoplesCollection;
use App\User;

class SearchController extends Controller
{
    /**
     * @api {GET} /api/search
     * @param GetPeoplesFormRequest $request
     * @param User $user
     * @return GetPeoplesResource
     */
    public function index(GetPeoplesFormRequest $request, User $user)
    {
        $users = $user->searchPeoples($request->name);
        
        return new GetPeoplesResource([
            'peoples' => PeoplesCollection::collection($users)
        ]);
    }
}
