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
        'uses' => 'CompaniesController@byCif'
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