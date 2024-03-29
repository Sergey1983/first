@extends('layouts.master')

@section('content')


<div class="container-fluid margin-top-25">

	<div class="col-md-5">

			{!! Form::open(['id'=>'register_user', 'class'=>'inline form-horizontal', 'method'=>'post'])!!}

				<div class="form-group">
					
					{!! Form::text('last_name', null, ['Placeholder'=>'Фамилия', "class"=>"form-control"]) !!}

				</div>

				
				<div class="form-group">
					
					{!! Form::text('name', null, ['Placeholder'=>'Имя', "class"=>"form-control"]) !!}

				</div>


				<div class="form-group">
					
					{!! Form::text('patronymic', null, ['Placeholder'=>'Отчество', "class"=>"form-control"]) !!}

				</div>

				<div class="form-group">

				{!! Form::text('email', null, ['Placeholder'=>'email', "class"=>"form-control"]) !!}

				</div>


				<div class="form-group">
					
					{!! Form::select('branch_id', $branches, null, ["class"=>"form-control"])!!}

				</div>

				
				<div class="form-group">

				{!! Form::password('password', ['Placeholder'=>'password', "class"=>"form-control"]) !!}

				</div>

				<div class="form-group">

				{!! Form::password('password_confirmation', ['Placeholder'=>'password confirmation', "class"=>"form-control"]) !!}

				</div>

				<div class="form-group text-center">

					{!! Form::submit('Создать!', ["class"=>'btn btn-primary']) !!}

				</div>

			{!! Form::close() !!}


	</div>

</div>

@include('layouts.errors')

@endsection
