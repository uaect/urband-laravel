<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];
    protected $table = 'album';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function artist(){
        return $this->hasMany(Artist::class, 'id', 'id')->select('id');
    }
    public function tracks(){
        return $this->hasMany(AlbumFiles::class);
    }
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
}
