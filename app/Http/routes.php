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

//Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


get('/', function()
{
   if(Auth::check()) return 'Weclome back, ' . Auth::user()->name;

    return 'Hi guest. ' . link_to('login', 'Login with Google');
});

get('login', '\Meatings\Http\Controllers\Auth\AuthController@login');