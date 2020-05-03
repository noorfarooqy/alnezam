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
Route::get('/trip/shared/{share_id}/{trip_id}', 'sharing\sharingController@viewSharedFile');
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
        Route::get('{client_id}/trip/{trip_id}', 'client\clientController@viewclientItems');
        Route::post('list', 'client\clientController@viewclientList');
        Route::post('new', 'client\clientController@ApiAddNewclient')->name('new_client');
    });
    Route::prefix('/items')->group(function () {
        Route::get('new', 'item\itemController@showNewitemForm');
        Route::get('list/{trip_id}', 'item\itemController@viewitemList');
        Route::post('list', 'item\itemController@ApiviewitemList');
        Route::post('new', 'item\itemController@ApiAddNewitem')->name('new_item');
    });
    Route::prefix('/share')->group(function () {
        Route::get('trip/{trip_id}', 'sharing\sharingController@showShareTripForm');
        Route::post('trip', 'sharing\sharingController@shareTripFile')->name('trip_share');
    });

    Route::prefix('/accounts')->group(function () {
        Route::get('/type', 'accounts\AccountTypeController@ViewListOfAccountsTypes');
        Route::post('/type', 'accounts\AccountTypeController@AddNewAccountType');
        Route::get('/type/{type_id}', 'accounts\AccountsController@ViewAccountsOnGivenType');
        Route::post('/new', 'accounts\AccountsController@AddNewAccount');
        Route::get('/account/{ac_id}', 'accounts\AccountsController@OpenEntriesForAccountGiven');
        Route::prefix('entries')->group(function(){
            Route::get('/', 'accounts\JournalEntriesController@ShowEntriesPage');
            Route::post('/new', 'accounts\JournalEntriesController@RecordEntry');
            Route::get('/{entry_id}', 'accounts\JournalEntriesController@OpenGivenEntry');
        });
    });
});

Route::get('/home', 'HomeController@index')->name('home');
