<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventArtistRelation extends Model
{
    protected $guarded = [];
    protected $table = 'event_artist';
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function events(){
        return $this->belongsTo(Event::class)->withTimestamps();
    }
    public function artist(){
        return $this->hasOne(Artist::class);
    }
}
