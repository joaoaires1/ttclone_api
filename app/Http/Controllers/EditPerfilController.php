<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditPerfilRequest;
use Image;

class EditPerfilController extends Controller
{
    public function editPerfil (EditPerfilRequest $request)
    {
        $user   = $request->user;

        try {

            if ( $request->photo ) {
                $avatar         = \Str::random(30);
                $url            = url("uploads/avatar/{$avatar}.jpg");
                $user->avatar   = $url;

                Image::make($request->photo)->resize(300, 300)->save("uploads/avatar/{$avatar}.jpg");
                Image::make($request->photo)->resize(50, 50)->save("uploads/avatar/{$avatar}-mini.jpg");
            }

            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();

            return response()->json(['success' => true, 'user' => $user]);

        } catch (\Throwable $th) {

            return response()->json(['success' => false]);
        }
    }
}
