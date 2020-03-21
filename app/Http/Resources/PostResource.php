<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'text' => $this->text,
            'created_at' => formatPostCreatedAt($this->created_at),
            'user' => [
                'name' => $this->user->name,
                'username' => $this->user->username,
                'avatar' => url("img/cache/avatar/{$this->user->avatar}")
            ]
        ];
    }
}
