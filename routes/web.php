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

    $client = new \GuzzleHttp\Client([
        'cookies' => true
    ]);

    $r = $client->request('GET', 'http://www.mfinante.ro/infocodfiscal.html', [
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'
        ],
        'query' => [
            'cod' => '15779899',
            'pagina' => 'domenii',
            'B1' => 'VIZUALIZARE'
        ],
        'allow_redirects' => true,
        'debug' => true
    ]);


    echo $r->getBody()->getContents();


});

Route::get('/login/{token}', [
    'as' => 'login.token',
    'uses' => 'Auth\LoginController@byToken'
]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('trips', [
        'as' => 'trips',
        'uses' => 'TripsController@trips'
    ]);

    Route::get('/trips/new', [
        'as' => 'trip.new',
        'uses' => 'TripsController@new'
    ]);

    Route::post('/trips/new', [
        'as' => 'trip.start',
        'uses' => 'TripsController@start'
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
//    Route::get('/places', [
//        'as' => 'places',
//        'uses' => 'PlacesController@search'
//    ]);

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
