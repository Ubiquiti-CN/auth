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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::get('config/global', 'Config\GlobalController@index');
    Route::post('config/global', 'Config\GlobalController@create');

    Route::get('site/list', 'Site\ConfigController@index');
    Route::get('site/detail/{site_id}/{auth_type?}', 'Site\ConfigController@show');
    Route::post('site/detail', 'Site\ConfigController@create');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);
