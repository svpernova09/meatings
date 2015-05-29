@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Profile
                        @if ($user == Auth::user())
                            <span class="pull-right">
                                <a href="{{ URL::route('users.edit', $user->id) }}">Edit Profile</a>
                            </span>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <h4>Name:</h4>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Email:</h4>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Avatar:</h4>
                            <p><img src="{{ $user->avatar }}"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
