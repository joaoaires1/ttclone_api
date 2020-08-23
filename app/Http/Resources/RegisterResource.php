<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->userSignIn();
        
        return [
            "success"   => true,
            'user'    => [
                "access"    => $this['access'],
                'name' => $this['name'],
                'username' => $this['username'],
                'avatar' => url("img/cache/avatar/{$this['avatar']}")
            ]
        ];
    }
}
