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

Route::group(['middleware' => 'auth'], function () {


    Route::get('/companies/external/', [
        'as' => 'companies.external',
        function (\Illuminate\Http\Request $request) {

            $cif = $request->query('cif');


            $cif = strtolower($cif);
            $cif = str_replace('ro', '', $cif);

            if (strlen($cif) != 8) {
                return new \Illuminate\Http\JsonResponse((object)[]);
            }

            $url = 'https://legacy.openapi.ro/api/companies/>cif<.json';
            $url = str_replace('>cif<', $cif, $url);

            $client = new \GuzzleHttp\Client([
//        'cookies' => true
            ]);

            try {
                $r = $client->request('GET', $url, [
                    'allow_redirects' => true,
//        'debug' => true
                ]);

                $r = \GuzzleHttp\json_decode($r->getBody()->getContents());

            } catch (\Exception $e) {
                $r = (object)[];
            }

            return new \Illuminate\Http\JsonResponse($r);

        }]);



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

    Route::put('/trips/edit', [
        'as' => 'trips.edit',
        'uses' => 'TripsController@edit'
    ]);


    Route::get('/companies', [
        'as' => 'companies',
        'uses' => 'CompaniesController@new'
    ]);

    Route::get('/companies/new', [
        'as' => 'companies.new',
        'uses' => 'CompaniesController@new'
    ]);

    Route::post('companies/new', [
        'as' => 'companies.new',
        'uses' => 'CompaniesController@storeNew'
    ]);

    Route::post('companies/new', [
        'as' => 'companies.new',
        'uses' => 'CompaniesController@storeNew'
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
