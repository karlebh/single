<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([

    'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers',
    // 'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
	Route::post('register', 'AuthController@register');

});

	Route::resource('music', 'MusicController');
// Route::post('register', 'Auth\RegisterController@register');