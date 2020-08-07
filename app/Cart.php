<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $table = 'cart';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
