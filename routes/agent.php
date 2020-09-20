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

Route::group( [
    'prefix' => 'agent',
], function () {
    Route::namespace( 'Agent' )->group( function () {
        Route::group([
            "middleware"=>\App\Http\Middleware\AgentLogin::class
        ],function (){
            Route::get('login',"AgentRegisterController@login");
            Route::get('template',"AgentRegisterController@template");
            Route::post('login',"AgentRegisterController@login");
            Route::post('register',"AgentRegisterController@register");
            Route::get('verify/{agent_id}',"AgentRegisterController@verify");
        });
        Route::group([
            "middleware"=>\App\Http\Middleware\AgentAuth::class
        ],function (){
            Route::get('logout',"AgentDashboardController@logout");
            Route::get('dashboard',"AgentDashboardController@dashboard");
            Route::get('settings',"AgentDashboardController@settings");
            Route::post('settings',"AgentDashboardController@settings");
        });
    } );

} );

