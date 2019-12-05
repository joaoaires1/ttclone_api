<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            "id"        => $this["id"],
            "user_id"   => $this["user_id"],
            "text"      => $this["text"],
            "created_at" => Carbon::parse($this["created_at"])->toDateTimeString(),
            "user"      => $this["user"]
        ];
    }
}
