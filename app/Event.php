<?php

namespace App;

use App\Http\Controllers\EventTickets;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
    public function list(){
        return $this->hasMany(EventArtistRelation::class, 'event_id', 'id')->latest();
    }
    public function packages(){
        return $this->hasMany(EventPackages::class, 'event_id', 'id')->latest();
    }
    public function ticket(){
        return $this->hasMany(EventTickets::class, 'event_id', 'id')->latest();
    }
}
