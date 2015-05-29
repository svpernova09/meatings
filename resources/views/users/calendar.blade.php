@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ Auth::user()->name }}'s Upcoming Events</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <h4>Summary</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <h4>Start Time</h4>
                                    </div>
                                </div>
                            </li>
                            @foreach ($events as $event)
                                <li class="list-group-item ">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            {{ $event->summary }}
                                        </div>
                                        <div class="col-xs-4">
                                            {{ $event->start->dateTime }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
