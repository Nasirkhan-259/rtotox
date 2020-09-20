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
    'prefix' => 'corporate',
], function () {
    Route::namespace( 'Corporate' )->group( function () {

        Route::group([
            "middleware"=>\App\Http\Middleware\CorporateAuth::class
        ],function (){

            Route::get('set-currency/{currency}',"CorporateController@SetCurrency");
            Route::get('dashboard',"CorporateController@dashboard");
            Route::get('test',"CorporateController@test");
            Route::get('logout',"CorporateController@logout");
            Route::post('saveTrip', "CorporateController@saveTrip");
            Route::post('saveTripHotel', "CorporateController@saveTripHotel");
            Route::get('flight_search', "CorporateController@flightSearch");
            Route::get('hotel_search', "CorporateController@hotelSearch");
            Route::get('searchHotel', "CorporateController@searchHotel");
            Route::get('searchHotelDetails','CorporateController@searchHotelDetails');
            Route::post('hotels/mail_itineraries_to_user','CorporateController@HotelmailItinerariesToUser');
            Route::get('search_flight', "CorporateController@searchFlight");
            Route::post('mail_itineraries_to_user', "CorporateController@mailItinerariesToUser");
            Route::get('trips_cart', "CorporateController@tripsCart");
            Route::post('save_itineraries_in_cart', "CorporateController@saveItinerariesInCart");
            Route::post('save_hotel_itineraries_in_cart', "CorporateController@saveHotelitineraries_in_cart");
            Route::get('load_saved_itineraries', "CorporateController@loadSavedItineraries");
            Route::post('delete_itinerary_from_cart', "CorporateController@deleteItineraryFromCart");
            Route::get('trip/{CorporateTripMasterId}/proceed_for_approval', "CorporateController@proceedForApproval");
            Route::get('flight/load_fare_rules','CorporateController@loadFareRules');
            Route::get('profile',"CorporateController@profile");
            Route::post('profile/update',"CorporateController@update");

            Route::match(['get', 'post'], 'trip/save_and_send_notification_to_approvers','CorporateController@saveAndSendNotificationToApprovers');

            //Departments Routes
            Route::group( [
                'prefix' => 'department',
            ], function () {
                Route::get('/',"DepartmentsController@index")->middleware("permissions:is_admin");
                Route::get('add',"DepartmentsController@department")->middleware("permissions:is_admin");;
                Route::post('add',"DepartmentsController@add_department")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"DepartmentsController@edit_department")->middleware("permissions:is_admin");;
                Route::post('update',"DepartmentsController@update")->middleware("permissions:is_admin");;
            });

            //Approver Routes
            Route::group( [
                'prefix' => 'workflow',
            ], function () {
                Route::get('/',"ApproverWorkFlowController@index")->middleware("permissions:is_admin");
                Route::get('add',"ApproverWorkFlowController@add")->middleware("permissions:is_admin");;
                Route::post('add',"ApproverWorkFlowController@add_post")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"ApproverWorkFlowController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"ApproverWorkFlowController@update")->middleware("permissions:is_admin");;
            });

            //WorkFlow Routes
            Route::group( [
                'prefix' => 'approver',
            ], function () {
                Route::get('/',"ApproverController@index")->middleware("permissions:is_admin");
                Route::get('add',"ApproverController@add")->middleware("permissions:is_admin");;
                Route::post('add',"ApproverController@add_post")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"ApproverController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"ApproverController@update")->middleware("permissions:is_admin");;
                Route::get('check_query',"ApproverController@check_query")->middleware("permissions:is_admin");;
            });

            //Policy Routes
            Route::group( [
                'prefix' => 'policy',
            ], function () {
                Route::get('/',"PolicyController@index")->middleware("permissions:is_admin");
                Route::get('add',"PolicyController@add")->middleware("permissions:is_admin");
                Route::post('add',"PolicyController@add_post")->middleware("permissions:is_admin");
                Route::get('edit/{id}',"PolicyController@edit")->middleware("permissions:is_admin");
                Route::post('update',"PolicyController@update")->middleware("permissions:is_admin");
                Route::get('setup/{id}',"PolicyController@setup")->middleware("permissions:is_admin");
                Route::post('setup',"PolicyController@setup_add")->middleware("permissions:is_admin");
            });


            //Destination Routes
            Route::group( [
                'prefix' => 'destination',
            ], function () {
                Route::get('/',"DestinationController@index")->middleware("permissions:is_admin");
                Route::get('add',"DestinationController@department")->middleware("permissions:is_admin");;
                Route::post('add',"DestinationController@add_department")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"DestinationController@edit_department")->middleware("permissions:is_admin");;
                Route::post('update',"DestinationController@update")->middleware("permissions:is_admin");;
            } );

            //CostCenter Routes
            Route::group( [
                'prefix' => 'costcenter',
            ], function () {
                Route::get('/',"CorporateCostCenterController@index")->middleware("permissions:is_admin");
                Route::get('add',"CorporateCostCenterController@department")->middleware("permissions:is_admin");;
                Route::post('add',"CorporateCostCenterController@add_department")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"CorporateCostCenterController@edit_department")->middleware("permissions:is_admin");;
                Route::post('update',"CorporateCostCenterController@update")->middleware("permissions:is_admin");;
                Route::get('search',"CorporateCostCenterController@search")->middleware("permissions:is_admin");
            } );

            //Employee Routes
            Route::group( [
                'prefix' => 'employee',
            ], function () {
                Route::get('/',"EmployeeController@index")->middleware("permissions:is_admin");
                Route::get('add',"EmployeeController@employee")->middleware("permissions:is_admin");;
                Route::post('add',"EmployeeController@add")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"EmployeeController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"EmployeeController@update")->middleware("permissions:is_admin");;
                Route::get('search',"EmployeeController@search")->middleware("permissions:is_admin");
                Route::get('search_name',"EmployeeController@search_name")->middleware("permissions:is_admin");
                Route::get('filter',"EmployeeController@filter_employees")->middleware("permissions:is_admin");
            } );


            //TripRejection Routes
            Route::group( [
                'prefix' => 'triprejection',
            ], function () {
                Route::get('/',"TriprejectionController@index")->middleware("permissions:is_admin");
                Route::get('add',"TriprejectionController@triprejection")->middleware("permissions:is_admin");;
                Route::post('add',"TriprejectionController@add")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"TriprejectionController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"TriprejectionController@update")->middleware("permissions:is_admin");;
            } );

            //Tripreason Routes
            Route::group( [
                'prefix' => 'tripreason',
            ], function () {
                Route::get('/',"TripreasonController@index")->middleware("permissions:is_admin");
                Route::get('add',"TripreasonController@tripreason")->middleware("permissions:is_admin");;
                Route::post('add',"TripreasonController@add")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"TripreasonController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"TripreasonController@update")->middleware("permissions:is_admin");;
            } );

            //branchemail Routes
            Route::group( [
                'prefix' => 'branchemail',
            ], function () {
                Route::get('/',"BranchemailController@index")->middleware("permissions:is_admin");
                Route::get('add',"BranchemailController@branchemail")->middleware("permissions:is_admin");;
                Route::post('add',"BranchemailController@add")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"BranchemailController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"BranchemailController@update")->middleware("permissions:is_admin");;
            });

            //flight rules Routes
            Route::group( [
                'prefix' => 'flightrules',
            ], function () {
                Route::get('/',"FlightruleController@index")->middleware("permissions:is_admin");
                Route::get('add',"FlightruleController@add")->middleware("permissions:is_admin");;
                Route::post('add',"FlightruleController@add_flightrule")->middleware("permissions:is_admin");;
                Route::get('edit/{id}',"FlightruleController@edit")->middleware("permissions:is_admin");;
                Route::post('update',"FlightruleController@update")->middleware("permissions:is_admin");;
            });


        });
        Route::group([
            "middleware"=>\App\Http\Middleware\CorporateLogin::class
        ],function (){
            Route::post('login',"CorporateController@login");
            Route::get('/{name}/forget/password',"CorporateController@forget_password");
            Route::post('/reset_password',"CorporateController@reset_password");
            Route::get('/{name}',"CorporateController@index");
        });
    } );

} );

