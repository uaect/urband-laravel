<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPackages extends Model
{
    protected $guarded = [];
    public function event(){
        return $this->belongsTo(Event::class);
    }
    public function ticket(){
        return $this->hasMany(EventTickets::class);
    }
}
