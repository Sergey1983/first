@extends('layouts.master')

@section('content')


<div class="container-fluid">

	<h2>Создать пользователя:</h2>

</div>

<div class="container-fluid">

	<div class="col-md-3">

		{!! Form::open(['id'=>'register_user', 'class'=>'inline form-horizontal', 'method'=>'post'])!!}


		<div class="form-group">
			
			{!! Form::text('name', null, ['Placeholder'=>'имя девачки', "class"=>"form-control"]) !!}

		</div>


		<div class="form-group">

		{!! Form::text('email', null, ['Placeholder'=>'email', "class"=>"form-control"]) !!}

		</div>


		<div class="form-group">

		{!! Form::password('password', ['Placeholder'=>'password', "class"=>"form-control"]) !!}

		</div>

		<div class="form-group">

		{!! Form::password('password_confirmation', ['Placeholder'=>'password confirmation', "class"=>"form-control"]) !!}

		</div>

		<div class="form-group">

			{!! Form::submit('Создать!', ["class"=>'btn btn-primary']) !!}

		</div>

		{!! Form::close() !!}

	</div>

</div>


@include('layouts.errors')

@endsection
