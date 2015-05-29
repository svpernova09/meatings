<?php namespace Meatings\Http\Controllers;

use Meatings\Http\Requests;
use Meatings\Http\Controllers\Controller;
use Meatings\User;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_EventAttendee;
use Illuminate\Http\Request;

class CalendarController extends Controller {
    private $user;

    function __construct( User $user ) {
        $this->user = $user;
    }


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
	public function create($user_id)
	{

        $user = $this->user->find($user_id);

        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APP_NAME'));
//        $client->setClientId(env('GOOGLE_CLIENT_ID'));
//        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setDeveloperKey($user->token);
        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event();
        $event->setSummary('Appointment');
        $event->setLocation('Somewhere');
        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDateTime('2011-06-03T10:00:00.000-07:00');
        $event->setStart($start);
        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDateTime('2011-06-03T10:25:00.000-07:00');
        $event->setEnd($end);
        $attendee1 = new Google_Service_Calendar_EventAttendee();
        $attendee1->setEmail('joe@joeferguson.me');

        $attendees = array($attendee1);
        $event->attendees = $attendees;
        $createdEvent = $service->events->insert('primary', $event);

        echo $createdEvent->getId();
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

        $user = $this->user->find($user_id);

        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APP_NAME'));
//        $client->setDeveloperKey(env('GOOGLE_API'));
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->authenticate($user->token);
        $access_token = $client->getAccessToken();
        $client->setAccessToken($access_token);


        $service = new Google_Service_Calendar($client);

        $calendarId = $user->calendar_id;
        $optParams = array(
            'maxResults' => 5,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = [];
        if (count($results->getItems()) > 0) {
            foreach ( $results->getItems() as $event ) {
                $events[] = $event;
            }
        }

        return view('users.calendar')->with('events', $events);
    }

}
