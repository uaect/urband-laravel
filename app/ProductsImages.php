<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    protected $guarded = [];
    public function product(){
        return $this->belongsTo(Products::class,'products_id');
    }
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
    public function orderitem(){
        return $this->belongsTo(OrderItems::class,'products_id');
    }
}
