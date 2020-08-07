<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function productsImages(){
        return $this->hasMany(ProductsImages::class,'products_id','id');
    }
    public function category(){
        return $this->belongsTo(ProductsCategory::class,'category');
    }
    public function orderitem(){
        return $this->hasMany(OrderItems::class,'product_id','id');
    }
    public function scopeActive($query){
        return $query->where('status',1);
    }
}
