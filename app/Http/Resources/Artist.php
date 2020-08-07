<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Artist extends JsonResource
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
            'name' => $this->name,
            'genre' => $this->genre,
            'about' => $this->about,
            'image' => URL::to('/storage/'.$this->image)
        ];
    }
    public function with($request){
        return [
            'version' => '1.0.0',
            'author_url' => url('http://laravel.com'),
            'Content-Type' => 'application/json'
        ];
    }
}
