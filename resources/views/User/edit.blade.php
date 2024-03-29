
@extends('layouts.master')

@section('content')


<div class="container-fluid margin-top-25">

	<div class="col-md-5">


		{!! Form::open(['id'=>'register_user', 'class'=>'inline', 'route'=>array('user.update', $user->id)])!!}


			<div class="form-group">

				{!! Form::text('name', $user->name, ['Placeholder'=>'Имя', "class"=>"form-control"]) !!}

			</div>


			<div class="form-group">

				{!! Form::text('last_name', $user->last_name, ['Placeholder'=>'Фамилия', "class"=>"form-control"]) !!}

			</div>

			<div class="form-group">
				
				{!! Form::text('patronymic', $user->patronymic, ['Placeholder'=>'Отчество', "class"=>"form-control"]) !!}

			</div>

			<div class="form-group">

				{!! Form::text('email', $user->email, ['Placeholder'=>'email', "class"=>"form-control"]) !!}

			</div>

			<div class="form-group">
				
				{!! Form::select('branch_id', $branches, $user->branch_id, ["class"=>"form-control"])!!}

			</div>

			<div class="form-group">

				{!! Form::password('password', ['Placeholder'=>'password', "class"=>"form-control"]) !!}

			</div>

			<div class="form-group">

				{!! Form::password('password_confirmation', ['Placeholder'=>'password confirmation', "class"=>"form-control"]) !!}

			</div>

			<div class="form-group text-center">

				{!! Form::submit('Обновить!', ["class"=>'btn btn-primary']) !!}

			</div>

		{!! Form::close() !!}
		
	</div>	

</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid text-center margin-bottom-10">

	<div class="col-md-5">

			<h2>Может видеть все заявки филиала?</h2>

	</div>

</div>


<div class="container-fluid">

	<div class="col-md-5">

		{!! Form::open(['id'=>'permission_user', 'class'=>'inline', 'route'=>array('user.update_permission', $user->id)])!!}


@php

	$disabled = $user->id == '1' ? true : false ;

@endphp
			<div class="form-group text-center">

				{!! Form::select('permission', ['0' => 'Нет', '1' => 'Да'], $user->permission,

				['disabled' => $disabled, "class"=>"form-control"] 

				) !!}

			</div>

			<div class="form-group text-center">

				{!! Form::submit('Изменить права', ["class"=>'btn btn-primary']) !!}

			</div>

		{!! Form::close() !!}

	</div>

</div>

@unless ($user->role_id == 1)


<div class="container-fluid">

	<div class="col-md-5 text-center">

		<h2>Удалить менеджера?</h2>

	</div>

</div>



<div class="container-fluid">

	<div class="col-md-5">

		{!! Form::open(['id'=>'delete_user', 'class'=>'inline', 'method' => 'GET', 'route' => array('user.destroy-warning', $user) ])!!}

			<div class="form-group text-center">

				{!! Form::submit('Удалить', ["id" => "delete_button", "class"=>'btn btn-danger']) !!}

			</div>

		{!! Form::close() !!}

	</div>

</div>

@endunless


{{-- @include('layouts.errors')

<script type="text/javascript">
	
	$(document).ready(function(){

		$('#delete_button').on('click', function (event) {

			event.preventDefault();


		})

	});

</script> --}}



@endsection








