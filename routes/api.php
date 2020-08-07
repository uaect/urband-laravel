<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::post('login', 'API\UserController@login');
// Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'cors'], function() {
    Route::post('/login', 'api\UserController@login');
    Route::post('/register', 'api\UserController@register');
    Route::post('/aboutus', 'api\AboutController@aboutus');
    Route::post('/previousshow', 'api\AboutController@previousshow');
    Route::post('/spotlight', 'api\AboutController@spotlight');
    Route::post('/menues', 'api\AboutController@menues');
    //Route::get('/contactus', 'api\AboutController@index');
    Route::post('/artists', 'api\ArtistController@index');
    Route::post('/events', 'api\EventsController@index');
    Route::post('/ticketevents', 'api\EventsController@ticketevent');
    Route::post('/eventdetails', 'api\EventsController@details');
    Route::post('/clientsfeedback', 'api\ClientController@feedback');
    Route::post('/clients', 'api\ClientController@index');
    Route::post('/albums', 'api\AlbumController@index');
    Route::post('/albumdetails', 'api\AlbumController@details');
    Route::post('/gallerycategory', 'api\GalleryController@category');
    Route::post('/gallery', 'api\GalleryController@gallery');
    Route::post('/banners', 'api\BannerController@index');
    Route::post('/store', 'api\StoreController@index');
    Route::post('/storecategory', 'api\StoreController@category');
    Route::post('/productdetails', 'api\StoreController@details');
    Route::post('/addtocart', 'api\StoreController@addcart');
    Route::post('/getcart', 'api\StoreController@getcart');
    Route::post('/removecart', 'api\StoreController@removecart');
    Route::post('/address', 'api\StoreController@address');
    Route::post('/addaddress', 'api\StoreController@addaddress');
    Route::post('/removeaddress', 'api\StoreController@removeaddress');
    Route::post('/eventbooking', 'api\StoreController@eventbooking');
    Route::post('/proceedorder', 'api\StoreController@proceedorder');
    Route::post('/countries', 'api\StoreController@countries');
    Route::post('/getuser', 'api\UserController@getuser');
    Route::post('/edituser', 'api\UserController@edituser');
    Route::post('/getorderedlist', 'api\UserController@getorder');
    Route::post('/emiratescharge', 'api\StoreController@emiratescharge');
    Route::post('/visitors', 'api\UserController@visitors');
    Route::post('/social', 'api\AboutController@social');
    Route::post('/subscribe', 'api\AboutController@subscribe');
    Route::post('/updatequantity', 'api\StoreController@updatequantity');
    Route::post('/founded', 'api\AboutController@founded');
    Route::post('/contact_us', 'api\AboutController@contact_us');
});
