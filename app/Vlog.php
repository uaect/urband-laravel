<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vlog extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeActive($query){
        return $query->where('status',1);
    }
}
