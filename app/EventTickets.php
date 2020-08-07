<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTickets extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
    public function package(){
        return $this->belongsTo(EventPackages::class);
    }
}
