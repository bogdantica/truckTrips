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

Route::get('/logout', [
    'as' => 'logout-get',
    function () {
        \Auth::logout();
        return redirect('/');
    }
]);


Route::get('/test', function () {

    $trip = \App\Models\Trip::find(4);

    $trip->load([
        'driver',
        'transporter',
        'beneficiary',
        'startPoint',
        'points',
        'endPoint',
        'services',

    ]);

    dd($trip->toArray());

    $client = new \GuzzleHttp\Client([
//        'cookies' => true
    ]);

    $r = $client->request('GET', 'https://legacy.openapi.ro/api/companies/15779899.json', [
        'allow_redirects' => true,
//        'debug' => true
    ]);

    $resp = json_encode($r->getBody()->getContents());




    echo $r->getBody()->getContents();


});


Route::get('/login/{token}', [
    'as' => 'login.token',
    'uses' => 'Auth\LoginController@byToken'
]);

Route::group(['middleware' => ['auth', 'requireCompany']], function () {

    Route::get('trips', [
        'as' => 'trips',
        'uses' => 'TripsController@trips'
    ]);

    Route::get('/trips/new', [
        'as' => 'trips.new',
        'uses' => 'TripsController@new'
    ]);

    Route::post('/trips/new', [
        'as' => 'trips.new',
        'uses' => 'TripsController@storeNew'
    ]);

    Route::put('/trips/edit/{trip}', [
        'as' => 'trips.edit',
        'uses' => 'TripsController@edit'
    ]);

    Route::get('/trips/edit/{trip}', [
        'as' => 'trips.edit',
        'uses' => 'TripsController@edit'
    ]);

    Route::get('/drivers/new', [
        'as' => 'drivers.new',
        'uses' => 'DriversController@new'
    ]);

    Route::post('/drivers/new', [
        'as' => 'drivers.new',
        'uses' => 'DriversController@storeNew'
    ]);

    Route::get('/vehicles', [
        'as' => 'vehicles',
        'uses' => 'VehiclesController@vehicles'
    ]);

    Route::get('/vehicles/new', [
        'as' => 'vehicles.new',
        'uses' => 'VehiclesController@new'
    ]);

    Route::post('/vehicles/new', [
        'as' => 'drivers.new',
        'uses' => 'VehiclesController@storeNew'
    ]);


    Route::get('/drivers', [
        'as' => 'drivers',
        'uses' => 'DriversController@drivers'
    ]);

//    Route::get('/driver', [
//            'as' => 'driver',
//            'uses' => 'DriversController@dashboard',
//        ]
//    );
//
//    Route::post('/trip/end/{trip}/', [
//        'as' => 'trip.end',
//        'uses' => 'TripsController@end'
//    ]);
//
//    Route::get('/trip/running', [
//        'as' => 'trip.running',
//        'uses' => 'TripsController@running'
//    ]);
//
//
    Route::get('/places', [
        'as' => 'places',
        'uses' => 'PlacesController@search'
    ]);

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
