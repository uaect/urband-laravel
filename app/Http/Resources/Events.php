<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Events extends JsonResource
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
            'title' => $this->title,
            'headline' => $this->headline,
            'date_on' => $this->date_on,
            'location' => $this->location,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at
        ];
        // return parent::toArray($request);
    }
}
