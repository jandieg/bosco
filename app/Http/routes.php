<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'IndexController@index');
    Route::get('terminos-y-condiciones', 'IndexController@getTermsConditions');
    Route::get('ayuda', 'IndexController@getHelp');
    Route::get('contactanos', 'IndexController@getContactUs');
    Route::get('mascotas', 'PetsController@getPetsLost');
    Route::get('mascotas/perdidos', 'PetsController@getPetsLost');
    Route::get('mascotas/encontrados', 'PetsController@getPetsFound');

    Route::post('filter/mascotas/perdidos', 'PetsController@postPetsLost');
    Route::post('filter/mascotas/encontrados', 'PetsController@postPetsFound');
    
    Route::get('como-funciona', 'ServicesController@index');
    Route::get('como-funciona/web', 'ServicesController@getFunctioningWeb');
    Route::get('como-funciona/app', 'ServicesController@getFunctioningApp');
    Route::get('descargar-volante/{status}','ReportsController@getDownloadReport')->where('status','perdido|encontrado');

    Route::match(['get', 'post'], 'subscription','SubscriptionController@index');
    // Ajax Pet
    Route::get('mascotas-detalle', 'PetsController@getPetsDetail');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('mis-reportes', 'ReportsController@index');
        // Ajax Reports
        Route::get('mis-reportes-detalle-perdido', 'ReportsController@getReportsDetailLost');
        Route::get('mis-reportes-detalle-encontrado', 'ReportsController@getReportsDetailFound');
        // AJax Send ReportPost
        Route::get('mis-reportes-registrar', 'ReportsController@sendReport');
    });

    // Ajax Ubigeo
    Route::get('ubigeo-ciudades', 'UbigeoController@getUbigeoCity');
    Route::get('ubigeo-distritos', 'UbigeoController@getUbigeoDistrict');



    Route::post('registro','Auth\AuthController@register');
    Route::post('login','Auth\AuthController@login');
    Route::get('cerrar-sesion','Auth\AuthController@logout');

});

    Route::get('iniciar-sesion/fb', 'Auth\AuthController@redirectToProvider');
    Route::get('iniciar-sesion/fb/callback', 'Auth\AuthController@handleProviderCallback');
