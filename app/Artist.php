<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Artist extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function url(){
        return url("/artist/{$this->id}-".Str::slug($this->name));
    }
    public function album(){
        $albums = DB::table('album')
            ->leftJoin('album_artist_relation', 'album.id', '=', 'album_artist_relation.album_id')
            ->leftJoin('album_artist_relation', 'artist.id', '=', 'album_artist_relation.artist_id')
            ->select('album.title')
            ->get();
        return $albums;
    }
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
}
