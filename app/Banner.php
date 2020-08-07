<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
