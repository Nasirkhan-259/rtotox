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

require_once "agent.php";
require_once "corporate.php";



Route::group( [
    'prefix' => 'flights',
], function () {
    Route::get('load-fare-rules','AirController@loadFareRules');

    Route::namespace( 'Extra' )->group( function () {
        Route::get('airports','AjaxController@airports');
        Route::get('airlines','AjaxController@airlines');
    } );

} );

Route::group( [
    'prefix' => 'hotels',
], function () {
    Route::namespace( 'Extra' )->group( function () {
        Route::get('locations','AjaxController@locations');

    });
    Route::namespace( 'Hotels' )->group( function () {
        Route::get('search','HotelController@search');
        Route::get('details','HotelController@details');
        Route::get('searchHotel','HotelController@searchHotel');
        Route::get('searchHotelDetails','HotelController@searchHotelDetails');

    });
} );


