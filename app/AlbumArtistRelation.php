<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumArtistRelation extends Model
{
    protected $guarded = [];
    protected $table = 'album_artist_relation';
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function albums(){
        return $this->hasMany(Album::class);
    }
    public function artist(){
        return $this->hasMany(Artist::class);
    }
}
