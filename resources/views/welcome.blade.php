
{{ phpinfo()}}
@extends('layouts.master')

@section('content')



<div class="container-fluid text-center margin-top-25">

{!! Form::open(['id'=>'login', 'class'=>'form-inline', 'method'=>'post', 'route'=>'sessions.login'])!!}

	<div class="form-group">

		{!! Form::text('email', null, ['Placeholder'=>'email', "class"=>"form-control"]) !!}

	</div>

	<div class="form-group">

	{!! Form::password('password', ['Placeholder'=>'password' , 'class'=>"form-control"]) !!}

	</div>

{!! 
	Form::macro('buttonSignIn', function() {
    return '<button type="submit" class="btn btn-default">Войти! <span class="glyphicon glyphicon-log-in"></span></button>';
	});

 !!}

{!! Form::buttonSignIn() !!}

{!! Form::close() !!}

</div>

{{-- {{phpinfo()}}
 --}}

@include('layouts.errors')


@endsection