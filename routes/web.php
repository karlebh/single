<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/{any}', 'AppController@index')->where('any', '.*');

// Auth::routes();

