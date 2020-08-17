<?php

namespace App\Http\Controllers\api\perfil;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPerfilRequest;
use App\Http\Resources\EditPerfilResource;
use Image;

class EditController extends Controller
{
    /**
     * @api {PUT} /api/edit_perfil
     * @param EditPerfilRequest $request
     * @return EditPerfilResource
     */
    public function update(EditPerfilRequest $request)
    {
        try {
            return new EditPerfilResource([
                'user' => $request->user->updatePerfil($request)
            ]);
        } catch (\Throwable $th) {

            return response()->json(['success' => false]);
        }
    }
}
