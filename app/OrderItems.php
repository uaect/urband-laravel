<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $guarded = [];
    public function order(){
        return $this->belongsTo(Orders::class,'order_id');
    }
    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
    public function productimage(){
        return $this->hasOne(ProductsImages::class,'products_id','product_id');
    }
}
