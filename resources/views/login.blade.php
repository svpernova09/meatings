@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">

                    Welcome Guest, {!! link_to('login', 'Login with Google') !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
