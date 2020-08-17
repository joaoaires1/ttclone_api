<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StorePostResource extends JsonResource
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
            "id"        => $this['post']["id"],
            "user_id"   => $this['post']["user_id"],
            "text"      => $this['post']["text"],
            "created_at" => formatPostCreatedAt($this['post']["created_at"]),
            "user"      => [
                "name" => $this['user']['name'],
                "username" => $this['user']['username'],
                "avatar" => url("img/cache/avatar/{$this['user']['avatar']}")
            ]
        ];
    }
}
