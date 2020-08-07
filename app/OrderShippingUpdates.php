<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderShippingUpdates extends Model
{
    protected $guarded = [];
    public function order(){
        return $this->belongsTo(Orders::class,'order_id');
    }
}
