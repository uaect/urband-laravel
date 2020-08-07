<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderitems(){
        return $this->hasMany(OrderItems::class,'order_id','id')->latest();
    }
    public function shippingupdates(){
        return $this->hasMany(OrderShippingUpdates::class,'order_id','id')->latest();
    }
}
