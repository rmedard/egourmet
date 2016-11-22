<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@homeform')->name('home.home');

Route::get('/search_dish', 'HomeController@dish_autocomplete')->name('home.dish_autocomplete');

Route::get('/search_resto', 'HomeController@resto_autocomplete')->name('home.resto_autocomplete');

Route::get('/search', 'HomeController@search')->name('home.search');

Route::post('/persist', 'HomeController@persist')->name('home.persist');

Route::post('/', 'RatingsController@store')->name('ratings.store');

Route::get('/about', function(){
    return view('pages.about');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function (){

    Route::get('/', 'PagesController@dashboard')->name('admin');

    Route::resource('dishes', 'DishesController');

    Route::resource('restos', 'RestosController');

    Route::resource('cuisines', 'CuisinesController');

    Route::get('messages', 'MessagesController@index')->name('messages.index');

    Route::resource('users', 'UsersController');

    Route::get('settings', function(){
        return view('admin.pages.settings');
    })->name('settings');

    Route::post('/search_resto_admin', 'SearchController@searchResto')->name('search.resto');

    Route::post('/search_dish_admin', 'SearchController@searchDish')->name('search.dish');

    Route::get('/ratings', 'RatingsController@ratings')->name('ratings.overview');

    Route::get('/ratings_chart', 'RatingsController@ratingsChartData')->name('ratings.chart.data');

    Route::get('/ratings_export', 'RatingsController@exportRatingsToExcel')->name('ratings.export.excel');
});

Route::post('messages/store', 'MessagesController@store')->name('messages.store');
Route::post('/resto_post', 'RestosController@store')->name('any.restos.store');
Route::post('/dish_post', 'DishesController@store')->name('any.dishes.store');