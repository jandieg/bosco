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

// Route::get('/', function () {
//     return view('welcome');
// });

    Route::get('/', 'IndexController@index');
    Route::get('terminos-y-condiciones', 'IndexController@getTermsConditions');
    Route::get('ayuda', 'IndexController@getHelp');
    Route::get('contactanos', 'IndexController@getContactUs');
    Route::post('contactanos2', 'IndexController@postContactMail');
    Route::get('mascotas', 'PetsController@getPetsLost');
    Route::get('mascotas/perdidos', 'PetsController@getPetsLost');
    Route::get('mascotas/encontrados', 'PetsController@getPetsFound');

    Route::post('filter/mascotas/perdidos', 'PetsController@postPetsLost');
    Route::post('filter/mascotas/encontrados', 'PetsController@postPetsFound');

    Route::get('como-funciona', 'ServicesController@index');
    Route::get('como-funciona/web', 'ServicesController@getFunctioningWeb');
    Route::get('como-funciona/app', 'ServicesController@getFunctioningApp');
    Route::get('descargar-volante/{status}','ReportsController@getDownloadReport')->where('status','jpg|pdf');
    Route::get('facebook-post','ReportsController@postFacebook');

    Route::match(['get', 'post'], 'subscription','SubscriptionController@index');
    // Ajax Pet
    Route::get('mascotas-detalle', 'PetsController@getPetsDetail');

   Route::get('mis-reportes-detalle-perdido', 'ReportsController@getReportsDetailLost');
   Route::group(['middleware' => ['auth']], function () {
        Route::get('mis-reportes', 'ReportsController@index');
        Route::get('delete_report', 'ReportsController@delete_report');
        // Ajax Reports
        Route::get('mis-reportes-detalle-encontrado', 'ReportsController@getReportsDetailFound');
        // AJax Send ReportPost
        Route::post('mis-reportes-registrar', 'ReportsController@sendReport');
        Route::post('mis-reportes-encontrado', 'ReportsController@postEncontrado');
    });

    // Ajax Ubigeo
    Route::get('ubigeo-ciudades', 'UbigeoController@getUbigeoCity');
    Route::get('ubigeo-distritos', 'UbigeoController@getUbigeoDistrict');
    Route::get('search-pets', 'SearchController@search');
    Route::get('search-pets-by-location', 'SearchController@searchByLocation');



    Route::post('registro','Auth\AuthController@register');
    Route::post('login','Auth\AuthController@login');
    Route::get('cerrar-sesion','Auth\AuthController@logout');

    Route::get('iniciar-sesion/fb', 'Auth\AuthController@redirectToProvider');
    Route::get('iniciar-sesion/fb/callback', 'Auth\AuthController@handleProviderCallback');


    Route::get('politicas-y-privacidad', 'ServicesController@privacy');