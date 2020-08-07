<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function galleryImages(){
        return $this->hasMany(GalleryFiles::class);
    }
    public function category(){
        return $this->hasOne(GalleryCategory::class);
    }
    public function scopeActive($query){
        return $query->where('status',1);
    }
}
