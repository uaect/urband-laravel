<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentManagement extends JsonResource
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
            'title' => $this->title,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }
}
