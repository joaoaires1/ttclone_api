<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPerfilResource extends JsonResource
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
            "success" => true,
            "posts"   => $this["posts"],
            "user"    => [
                "name" => $this['user']->name,
                "username" => $this['user']->username,
                "avatar" => url("img/cache/avatar/{$this['user']->avatar}"),
                "own_perfil" => $this['user']->own_perfil,
                "is_following" => $this['user']->is_following
            ]
        ];
    }
}
