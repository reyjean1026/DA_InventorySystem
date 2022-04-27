<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    
    /**
     * Home Routes
     */
    //Route::get('/', 'HomeController@index')->name('home.index');
    Auth::routes();
    Route::get('/', 'LoginController@show')->name('login.show');
    Route::post('/', 'LoginController@login')->name('login.perform');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        //Route::get('/articles', 'ArticleController@index')->name('articles.index');
        //Route::post('/articles','ArticleController@articlestore')->name('articles.articlestore');
        Route::get('/home', 'HomeController@index')->name('home.index');

        Route::get('/articles', 'ArticleController@index')->name('articles.index');
        Route::get('articlestore','ArticleController@articles');
        Route::post('storearticle','ArticleController@articlestore');
        Route::get('categorystore','ArticleController@articles');
        Route::post('storecategory','ArticleController@categorystore');
      
        Route::get('/inventory', 'InventoryController@index')->name('inventory.index');
        Route::get('inventorystore','InventoryController@inventory');
        Route::post('storeinventory','InventoryController@inventorystore');

        Route::get('/property', 'PropertyController@index')->name('property.index');
        Route::get('propertystore','PropertyController@property');
        Route::post('storeproperty','PropertyController@propertystore');

        Route::get('/request', 'RequestController@index')->name('request.index');

        Route::get('/acquired', 'AcquiredController@index')->name('acquired.index');
        Route::get('acquiredstore','AcquiredController@acquired');
        Route::post('storeacquired','AcquiredController@acquiredstore');
        Route::get('transfermodalstore','AcquiredController@acquired');
        Route::post('storemodaltransfer','AcquiredController@transfermodalstore');
    });

    
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
