<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryFiles extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
}
