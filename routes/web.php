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

/**
 * Authenticate User
 */
Auth::routes();
Route::get('auth/socialite', 'Auth\SocialiteController@redirectToProvider')->name('redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\SocialiteController@handleProviderFacebookCallback');
Route::get('auth/google/callback', 'Auth\SocialiteController@handleProviderGoogleCallback');

/**
 * Route for Frontend
 */
Route::get('/', 'HomeController@shop');
Route::get('home', 'HomeController@shop')->name('home');
Route::get('shop', 'HomeController@shop')->name('shop');
Route::get('category/{category_id}-{slug}', 'HomeController@ProductOfCategory')->name('shop.category');

Route::get('your-cart', 'CartController@cart')->name('cart');
Route::get('add-cart-{id}', 'CartController@addItem')->name('cart-add');
Route::get('removeItem', 'CartController@removeItem')->name('cart-remove');
Route::get('updateItem', 'CartController@updateItem')->name('cart-update');

Route::get('select-city', 'HomeController@getCountyFromCity')->name('selectCity');
Route::get('select-county', 'HomeController@getTownshipFromCounty')->name('selectCounty');

Route::get('product/{pro_id}-{product_slug}', 'HomeController@singleProduct')->name('product');
Route::get('t{tra_id}-{trademark_slug}', 'HomeController@getProductOfTrademark')->name('trademark');
/*checkout*/
Route::group(['middleware' => ['checkout', 'auth']], function (){
    Route::get('checkout', 'HomeController@checkOut')->name('checkout');
    Route::post('checkout-store', 'OrderController@store')->name('checkout.store');
});
/*user profile*/
Route::group(['middleware' => 'auth'], function (){
    Route::get('my-order-{id}', 'UserController@myOrder')->name('my.order');
    Route::get('my-profile/{id}-{slug}', 'UserController@myProfile')->name('my.profile');
    Route::get('list-order', 'UserController@listOrder')->name('my.listOrder');
    /*Wish list*/
    Route::post('add-wishlist', 'UserController@addWishList')->name('add-wishlist');
    Route::post('remove-wishlist', 'UserController@removeWishList')->name('remove-wishlist');
    Route::get('my-wishlist', 'UserController@wishList')->name('wishlist');

});

/**
 * Authenticate Admin
 */
Route::post('admin-register', 'Admin\AdminRegisterController@register')->name('admin.register');
Route::get('admin-login', 'Admin\AdminLoginController@showLoginForm')->name('admin.showLoginForm');
Route::post('admin-login', 'Admin\AdminLoginController@login')->name('admin.login');
Route::post('admin-logout', 'Admin\AdminLoginController@logout')->name('admin.logout');

/**
 * Route for Backend
 */
Route::group(['prefix' => 'backend', 'middleware' => 'auth:admin'], function () {

    Route::get('/', 'ManagementController@dashBoard')->name('backend');

    /*category route*/
    Route::group(['prefix' => 'category'], function (){
        Route::get('list','CategoriesController@index')->name('backend.category.list');
        Route::get('view-{id}','CategoriesController@viewDetails')->name('backend.category.viewDetails');
        Route::get('create','CategoriesController@showCreateForm')->name('backend.category.showCreateForm');
        Route::post('store','CategoriesController@store')->name('backend.category.store');
        Route::get('edit-{id}','CategoriesController@showEditForm')->name('backend.category.showEditForm');
        Route::post('update','CategoriesController@update')->name('backend.category.update');
        Route::post('destroy','CategoriesController@destroy')->name('backend.category.destroy');
    });
    /*products route*/
    Route::group(['prefix' => 'products'], function (){
        Route::get('list', 'ProductsController@index')->name('backend.products.list');
        Route::get('view-{id}', 'ProductsController@view')->name('backend.products.view');
        Route::get('create', 'ProductsController@showCreateForm')->name('backend.products.showCreateForm');
        Route::post('store', 'ProductsController@store')->name('backend.products.store');
        Route::get('edit-{id}', 'ProductsController@showEditForm')->name('backend.products.showEditForm');
        Route::post('update', 'ProductsController@update')->name('backend.products.update');
        Route::post('destroy', 'ProductsController@destroy')->name('backend.products.destroy');
        Route::post('change-productStatus', 'ProductsController@changeStatus')->name('backend.products.changeStatus');
    });
    /*hardware route*/
    Route::group(['prefix' => 'hardware'], function (){
        Route::get('list','HardwareController@index')->name('backend.hardware.list');
        Route::get('view-{id}','HardwareController@viewDetails')->name('backend.hardware.viewDetails');
        Route::get('create','HardwareController@showCreateForm')->name('backend.hardware.showCreateForm');
        Route::post('store','HardwareController@store')->name('backend.hardware.store');
        Route::get('edit-{id}','HardwareController@showEditForm')->name('backend.hardware.showEditForm');
        Route::post('update','HardwareController@update')->name('backend.hardware.update');
        Route::post('destroy','HardwareController@destroy')->name('backend.hardware.destroy');
    });
    /*trademark route*/
    Route::group(['prefix' => 'trademarks'], function (){
        Route::get('list', 'TrademarksController@index')->name('backend.trademarks.list');
        Route::get('view-{id}', 'TrademarksController@view')->name('backend.trademarks.view');
        Route::get('create', 'TrademarksController@showCreateForm')->name('backend.trademarks.showCreateForm');
        Route::post('store', 'TrademarksController@store')->name('backend.trademarks.store');
        Route::get('edit-{id}', 'TrademarksController@showEditForm')->name('backend.trademarks.showEditForm');
        Route::post('update', 'TrademarksController@update')->name('backend.trademarks.update');
        Route::post('destroy', 'TrademarksController@destroy')->name('backend.trademarks.destroy');
    });
    /*Specs route*/
    Route::group(['prefix' => 'specs'], function (){
        Route::get('list', 'SpecsController@index')->name('backend.specs.list');
        Route::get('view-{id}', 'SpecsController@viewDetails')->name('backend.specs.viewDetails');
        Route::get('create', 'SpecsController@showCreateForm')->name('backend.specs.showCreateForm');
        Route::post('store', 'SpecsController@store')->name('backend.specs.store');
        Route::get('edit-{id}', 'SpecsController@showEditForm')->name('backend.specs.showEditForm');
        Route::post('update', 'SpecsController@update')->name('backend.specs.update');
        Route::post('destroy', 'SpecsController@destroy')->name('backend.specs.destroy');
        Route::post('change-status', 'SpecsController@changeStatus')->name('backend.specs.changeStatus');
        Route::post('change-spotlight', 'SpecsController@changeSpotlight')->name('backend.specs.changeSpotlight');
    });


});

