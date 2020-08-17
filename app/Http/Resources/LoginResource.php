<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            "id"        => $this["user"]["id"],
            "name"      => $this["user"]["name"],
            "username"  => $this["user"]["username"],
            "email"     => $this["user"]["email"],
            "access"    => $this["user"]["access"],
            "avatar"    => url("img/cache/avatar/{$this["user"]["avatar"]}") 
        ];
    }
}
