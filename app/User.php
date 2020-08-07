<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'through', 'facebook_id', 'city', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){
            return static::create($input);
        }


        return $check;
    }

    public function event(){
        return $this->hasMany(Event::class)->latest();
    }
    public function album(){
        return $this->hasMany(Album::class)->latest();
    }
    public function artist(){
        return $this->hasMany(Artist::class)->latest();
    }
    public function content(){
        return $this->hasMany(ContentManagement::class)->latest();
    }
    public function banner(){
        return $this->hasMany(Banner::class)->latest();
    }
    public function gallery(){
        return $this->hasMany(Gallery::class)->latest();
    }
    public function gallerycategory(){
        return $this->hasMany(GalleryCategory::class)->latest();
    }
    public function productcategory(){
        return $this->hasMany(ProductsCategory::class)->latest();
    }
    public function product(){
        return $this->hasMany(Products::class)->latest();
    }
    public function vlog(){
        return $this->hasMany(Vlog::class)->latest();
    }
    public function ProductAttribute(){
        return $this->hasMany(ProductAttributes::class)->latest();
    }
    public function previousshows(){
        return $this->hasMany(PreviousShows::class)->latest();
    }
    public function address(){
        return $this->hasMany(Address::class)->where('is_default',1);
    }
    public function order(){
        return $this->hasMany(Orders::class)->latest();
    }
    public function ticket(){
        return $this->hasMany(EventTickets::class)->latest();
    }
    public function shipping(){
        return $this->hasMany(Shipping::class)->latest();
    }
    public function countries(){
        return $this->hasMany(Shipping::class)->latest();
    }
    public function contentImage(){
        return '/storage/'. ($this->image) ? $this->image : 'assets/argon/img/theme/no_image.png';
    }
}
