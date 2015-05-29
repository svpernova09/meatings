@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <h4>Name</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <h4>Email</h4>
                                    </div>
                                </div>
                            </li>
                            @foreach ($users as $user)
                                <li class="list-group-item ">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            {{ $user->name }}
                                        </div>
                                        <div class="col-xs-4">
                                            {{ $user->email }}
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
