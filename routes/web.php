<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use App\Mail\NewUserWelcomeMail;
// Route::get('/email', function () {
//     return new NewUserWelcomeMail();
// });
Route::get('/', 'HomeController@index')->name('home');
Route::get('/redirect', 'Auth\FacebookController@redirect');
Route::get('/callback', 'Auth\FacebookController@callback');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show','destroy']]);
    Route::post('/user/destroy', 'UserController@destroy')->name('user.destroy');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile/image', 'ProfileController@updateImage')->name('profile.image');;
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::resource('banner', 'BannerController', ['except' => ['destroy']]);
    Route::post('/banner/destroy', 'BannerController@destroy')->name('client.destroy');
	Route::resource('event', 'EventController', ['except' => ['destroy']]);
	Route::resource('artist', 'ArtistController', ['except' => ['destroy','show']]);
    Route::post('/artist/destroy', 'ArtistController@destroy')->name('artist.destroy');
	Route::get('artist/{artist}-{slug}', 'ArtistController@show')->name('artist.show');
	Route::resource('album', 'AlbumController', ['except' => ['destroy']]);
    Route::post('/album/destroy', 'AlbumController@destroy')->name('album.destroy');
    Route::post('/album/destroyfile', 'AlbumController@destroyfile')->name('album.destroyfile');
	Route::resource('client', 'ClientController', ['except' => ['destroy']]);
	Route::get('gallery', 'GalleryController@index')->name('gallery.index');
	Route::get('gallery/create', 'GalleryController@create')->name('gallery.create');
	Route::post('gallery/store', 'GalleryController@store')->name('gallery.store');
    Route::post('/gallery/storeMedia', 'GalleryController@storeMedia')->name('gallery.storeMedia');
    Route::post('/gallery/destroy', 'GalleryController@destroy')->name('gallery.destroy');
	Route::post('gallery/{id}', 'GalleryController@update')->name('gallery.update');
	Route::get('gallery/{id}/show', 'GalleryController@show')->name('gallery.show');
	Route::get('gallery/{id}/edit', 'GalleryController@edit')->name('gallery.edit');
	Route::resource('gallerycategories', 'GalleryCategoryController', ['except' => ['destroy']]);
    Route::post('/gallerycategories/destroy', 'GalleryCategoryController@destroy')->name('gallerycategories.destroy');
    Route::post('/client/destroy', 'ClientController@destroy')->name('client.destroy');
	Route::resource('clientfeedback', 'ClientFeedbackController', ['except' => ['destroy']]);
    Route::post('/clientfeedback/destroy', 'ClientFeedbackController@destroy')->name('clientfeedback.destroy');
    Route::post('/event/destroy', 'EventController@destroy')->name('event.destroy');
    Route::get('/about/who-we-are', 'AboutController@who_we_are')->name('about.who-we-are');
    Route::get('/about/what-we-do', 'AboutController@what_we_do')->name('about.what-we-do');
    Route::get('/about/gang', 'AboutController@gang')->name('about.gang');
    Route::get('/about/gang/add', 'AboutController@add_gang')->name('about.gang.add');
    Route::post('/about/insert_gang', 'AboutController@insert_gang')->name('about.insert_gang');
    Route::get('/about/gang/show/{id}', 'AboutController@show_gang')->name('about.gang.show');
    Route::get('/about/gang/edit/{id}', 'AboutController@edit_gang')->name('about.gang.edit');
    Route::post('/about/insert_about', 'AboutController@insert_about')->name('about.insert_about');
    Route::get('/about/what-we-do/add', 'AboutController@add_what_we_do')->name('about.what-we-do.add');
    Route::get('/about/what-we-do/edit/{$id}', 'AboutController@edit_what_we_do')->name('about.what-we-do.edit');
    Route::post('/about/destroy', 'AboutController@destroy')->name('about.destroy');
    Route::post('/about/what-we-do/show/{$id}', 'AboutController@show_what_we_do')->name('about.what-we-do.show');
    Route::post('/about/insert_what_we_do', 'AboutController@insert_what_we_do')->name('about.insert_what_we_do');
    Route::get('/contact/settings', 'AboutController@settings')->name('contact.settings');
    Route::post('/about/insert_settings', 'AboutController@insert_settings')->name('about.insert_settings');
	Route::resource('productscategory', 'ProductsCategoryController', ['except' => ['destroy']]);
    Route::post('/productscategory/destroy', 'ProductsCategoryController@destroy')->name('productscategory.destroy');
	Route::get('products', 'ProductsController@index')->name('products.index');
	Route::get('products/create', 'ProductsController@create')->name('products.create');
	Route::post('products/store', 'ProductsController@store')->name('products.store');
    Route::post('/products/storeMedia', 'ProductsController@storeMedia')->name('products.storeMedia');
    Route::post('/products/destroy', 'ProductsController@destroy')->name('products.destroy');
	Route::post('products/{id}', 'ProductsController@update')->name('products.update');
	Route::get('products/{id}/show', 'ProductsController@show')->name('products.show');
	Route::get('products/{id}/edit', 'ProductsController@edit')->name('products.edit');
	Route::get('vlogs', 'VlogController@index')->name('vlogs.index');
	Route::get('vlogs/create', 'VlogController@create')->name('vlogs.create');
	Route::post('vlogs/store', 'VlogController@store')->name('vlogs.store');
    Route::post('/vlogs/storeMedia', 'VlogController@storeMedia')->name('vlogs.storeMedia');
    Route::post('/vlogs/destroy', 'VlogController@destroy')->name('vlogs.destroy');
	Route::post('vlogs/{id}', 'VlogController@update')->name('vlogs.update');
	Route::get('vlogs/{id}/show', 'VlogController@show')->name('vlogs.show');
	Route::get('vlogs/{id}/edit', 'VlogController@edit')->name('vlogs.edit');
    Route::get('/previous-shows', 'PreviousShowsController@index')->name('previous_shows.index');
    Route::get('/previous_shows/create', 'PreviousShowsController@create')->name('previous_shows.create');
    Route::get('/previous_shows/createspotlight', 'PreviousShowsController@createspotlight')->name('previous_shows.createspotlight');
    Route::post('/previous_shows/destroy', 'PreviousShowsController@destroy')->name('previous_shows.destroy');
    Route::post('/previous-shows/insert_previous_shows', 'PreviousShowsController@insert_previous_shows')->name('previous_shows.insert');
    Route::post('/previous-shows/insertspotlight', 'PreviousShowsController@insert_spotlight')->name('previous_shows.insertspotlight');
    Route::post('/previous-shows/storeMedia', 'PreviousShowsController@storeMedia')->name('previous_shows.storeMedia');
	Route::get('tickets', 'EventTicketsController@index')->name('tickets.index');
    Route::post('/tickets/destroy', 'EventTicketsController@destroy')->name('tickets.destroy');
	Route::post('tickets/{id}', 'EventTicketsController@update')->name('tickets.update');
	Route::get('tickets/{id}/show', 'EventTicketsController@show')->name('tickets.show');
	Route::get('tickets/{id}/edit', 'EventTicketsController@edit')->name('tickets.edit');
	Route::post('/orders/destroystatus', 'OrdersController@destroystatus')->name('orders.destroystatus');
	Route::get('orders', 'OrdersController@index')->name('orders.index');
    Route::post('/orders/destroy', 'OrdersController@destroy')->name('orders.destroy');
	Route::post('orders/{id}', 'OrdersController@update')->name('orders.update');
	Route::get('orders/{id}/show', 'OrdersController@show')->name('orders.show');
	Route::get('orders/{id}/edit', 'OrdersController@edit')->name('orders.edit');
	Route::post('orders/updatestatus/{id}', 'OrdersController@updatestatus')->name('orders.updatestatus');
    Route::get('/pages', 'AboutController@pages')->name('pages');
    Route::post('/pages/change_status', 'AboutController@change_status')->name('pages.change_status');
	Route::resource('shipping', 'ShippingController', ['except' => ['destroy']]);
    Route::post('/shipping/destroy', 'ShippingController@destroy')->name('shipping.destroy');
	Route::resource('cities', 'CountriesController', ['except' => ['destroy']]);
    Route::post('/cities/destroy', 'CountriesController@destroy')->name('cities.destroy');
    Route::post('/pages/title_update', 'HomeController@title_update')->name('pages.title_update');
});
