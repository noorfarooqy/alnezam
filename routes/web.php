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



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::prefix('/launch')->group(function () {
        Route::get('new', 'shipping\shippingController@addNewShippingLaunch');
        Route::get('list', 'shipping\shippingController@viewShippingLaunchList');
        Route::post('new', 'shipping\shippingController@ApiaddNewShippingLaunch')->name('new_launch');
    });
    Route::prefix('/trip')->group(function () {
        Route::get('new', 'shipping\shippingController@showNewTripForm');
        Route::get('list', 'shipping\shippingController@getTripList');
        Route::get('view/{trip_id}', 'shipping\shippingController@viewTripGiven');
        Route::post('new', 'shipping\shippingController@ApiAddNewTrip')->name('new_trip');
    });
    Route::prefix('/karani')->group(function () {
        Route::get('new', 'karani\karaniController@showNewKaraniForm');
        Route::get('list', 'karani\karaniController@viewKaraniList');
        Route::post('new', 'karani\karaniController@ApiAddNewKarani')->name('new_karani');
    });
    Route::prefix('/clients')->group(function () {
        Route::get('new', 'client\clientController@showNewclientForm');
        Route::get('list', 'client\clientController@viewclientList');
        Route::post('list', 'client\clientController@viewclientList');
        Route::post('new', 'client\clientController@ApiAddNewclient')->name('new_client');
    });
    Route::prefix('/items')->group(function () {
        Route::get('new', 'item\itemController@showNewitemForm');
        Route::get('list', 'item\itemController@viewitemList');
        Route::post('list', 'item\itemController@viewitemList');
        Route::post('new', 'item\itemController@ApiAddNewitem')->name('new_item');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
