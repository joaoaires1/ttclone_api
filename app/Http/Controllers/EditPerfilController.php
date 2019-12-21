<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditPerfilRequest;

class EditPerfilController extends Controller
{
    public function editPerfil (EditPerfilRequest $request)
    {
        $user = $request->user;
        
        try {
            
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();

            return response()->json(['success' => true]);

        } catch (\Throwable $th) {
            return response()->json(['success' => false]);
        }
    }
}
