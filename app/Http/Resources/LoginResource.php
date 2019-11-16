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
            "id"        => $this["id"],
            "name"      => $this["name"],
            "username"  => $this["username"],
            "email"     => $this["email"],
            "api_token" => $this["api_token"]
        ];
    }
}
