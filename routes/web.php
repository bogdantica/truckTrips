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

Route::get('/login/{token}', [
    'as' => 'login.token',
    'uses' => 'Auth\LoginController@byToken'
]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/driver', [
            'as' => 'driver',
            'uses' => 'DriversController@dashboard',
        ]
    );

    Route::post('/trip/end/{trip}/', [
        'as' => 'trip.end',
        'uses' => 'TripsController@end'
    ]);

    Route::get('/trip/running', [
        'as' => 'trip.running',
        'uses' => 'TripsController@running'
    ]);

    Route::get('/trip/new', [
        'as' => 'trip.new',
        'uses' => 'TripsController@new'
    ]);

    Route::post('/trip/new', [
        'as' => 'trip.start',
        'uses' => 'TripsController@start'
    ]);

    Route::get('/places', [
        'as' => 'places',
        'uses' => 'PlacesController@search'
    ]);

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
