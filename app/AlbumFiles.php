<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumFiles extends Model
{
    protected $guarded = [];
    public function album(){
        return $this->belongsTo(Album::class);
    }
    public function artist(){
        return $this->belongsToMany(Artist::class);
    }
}
