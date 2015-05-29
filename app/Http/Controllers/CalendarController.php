<?php namespace Meatings\Http\Controllers;

use Meatings\Http\Requests;
use Meatings\Http\Controllers\Controller;
use Meatings\User;
use Google_Service_Calendar;

use Illuminate\Http\Request;

class CalendarController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($user_id)
	{

        $user = User::find($user_id);

        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APP_NAME'));
        $client->setDeveloperKey(env('GOOGLE_API'));
        $service = new Google_Service_Calendar($client);



        $calendarId = $user->calendar_id;
        $optParams = array(
            'maxResults' => 5,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);

        if (count($results->getItems()) > 0) {
            print "Upcoming events:\n";
            foreach ( $results->getItems() as $event ) {
                var_dump($event);
            }
        }
	}



}
