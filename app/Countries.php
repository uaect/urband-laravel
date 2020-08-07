<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shipping(){
        return $this->hasMany(Shipping::class,'cities','id');
    }
    public function area(){
        return $this->hasMany(Countries::class,'parent_id','id');
    }
}
