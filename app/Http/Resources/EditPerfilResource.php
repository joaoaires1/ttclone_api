<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EditPerfilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "success"   => true,
            "name"      => $this->name,
            "avatar"    => url("img/cache/avatar/{$this->avatar}") 
        ];
    }
}
