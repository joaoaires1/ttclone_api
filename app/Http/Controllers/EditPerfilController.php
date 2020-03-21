<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditPerfilRequest;
use App\Http\Resources\EditPerfilResource;
use Image;

class EditPerfilController extends Controller
{
    public function editPerfil (EditPerfilRequest $request)
    {
        $user   = $request->user;

        try {

            if ( $request->photo ) {
                $avatar         = \Str::random(30);
                $url            = "{$avatar}.jpg";
                $user->avatar   = $url;

                Image::make($request->photo)->save("uploads/avatar/{$avatar}.jpg");
            }

            $user->name = $request->name;
            $user->save();

            return new EditPerfilResource($user);

        } catch (\Throwable $th) {

            return response()->json(['success' => false]);
        }
    }
}
