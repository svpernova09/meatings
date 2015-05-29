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
Route::get('/test', function()
{
    $user = Meatings\User::find(1);
    $client = new \Google_Client();
    $client->setApplicationName(env('GOOGLE_APP_NAME'));
    $client->setDeveloperKey($user->token);


    $service = new Google_Service_Calendar($client);


    $calendarList = $service->calendarList->listCalendarList();

    while(true) {
        foreach ($calendarList->getItems() as $calendarListEntry) {
            echo $calendarListEntry->getSummary();
        }
        $pageToken = $calendarList->getNextPageToken();
        if ($pageToken) {
            $optParams = array('pageToken' => $pageToken);
            $calendarList = $service->calendarList->listCalendarList($optParams);
        } else {
            break;
        }
    }
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
]);

Route::get('login', '\Meatings\Http\Controllers\Auth\AuthController@login');
Route::resource('users', '\Meatings\Http\Controllers\UserController');
Route::get('user/{user}/calendar', ['as' => 'user.calendar', 'uses' => 'CalendarController@show']);

Route::get('user/{user}/create', ['as' => 'user.calendar.create', 'uses' => 'CalendarController@create']);