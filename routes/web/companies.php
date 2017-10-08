<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 08/10/2017
 * Time: 13:55
 */

Route::group(['middleware' => ['auth']], function () {

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

});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/companies/new/{owner?}', [
        'as' => 'companies.new.byOwner',
        'uses' => 'CompaniesController@new'
    ]);

    Route::post('companies/new/{owner?}', [
        'as' => 'companies.new.byOwner',
        'uses' => 'CompaniesController@storeNew'
    ]);

});