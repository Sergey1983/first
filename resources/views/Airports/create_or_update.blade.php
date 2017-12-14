@extends('layouts.master')

@section('content')

{{-- <div class="container-fluid text-center margin-bottom-10">
	
	<h3>{{$action}} аэропорт</h3>

</div> --}}


@php

	$keys = array('country', 'city', 'name', 'code', 'popularity');

	foreach ($keys as $key) {

		${$key} = $action == 'Создать' ? null : $airport->{$key};

	}

	$route = $action == 'Создать' ? 'airports.store' : ['airports.update', $airport->id];

	$method = $action == 'Создать' ? 'post' : 'put';

@endphp

<div class="container-fluid margin-top-25">

		<div class="col-md-5">
	
			{!!Form::open(['class' =>'form-horizontal', 'route'=> $route, 'method'=>$method])!!}


					 	<div class="form-group" id="status">


							{!! Form::label('country', 'Страна', ['class'=>'control-label  col-md-3'])!!}

							<div class="col-md-6">

							{!! Form::select ('country', $countries , $country , ['placeholder' =>  'Выберите страну', 'class'=>"form-control", 'required'])!!}

						 	</div>

						</div>


					 	<div class="form-group">


							{!! Form::label('city', 'Город', ['class'=>'control-label col-md-3'])!!}

							<div class="col-md-6">

						 		{!! Form::text('city', $city, ['placeholder' =>  'Введите город', 'class'=>"form-control"] )  !!}

						 	</div>


						</div>



					 	<div class="form-group">


							{!! Form::label('name', 'Название', ['class'=>'control-label col-md-3'])!!}

							<div class="col-md-6">

						 		{!! Form::text('name', $name, ['placeholder' =>  'Введите название аэропорта', 'class'=>"form-control"] )  !!}

						 	</div>


						</div>



					 	<div class="form-group">


							{!! Form::label('code', 'Код', ['class'=>'control-label  col-md-3'])!!}

							<div class="col-md-6">

						 		{!! Form::text('code', $code, ['placeholder' =>  'Введите код аэропорта', 'class'=>"form-control", 'required'] )  !!}

						 	</div>

						</div>


					 	<div class="form-group" id="status">


							{!! Form::label('popularity', 'Популярность', ['class'=>'control-label  col-md-3'])!!}

							<div class="col-md-6">

  								<input type="number" name="popularity" min="0" max="300" class="form-control width-25" value="{{$popularity}}">

						 	</div>

						</div>


						<div class="form-group  padding-left-14">

							{!! Form::submit('Сохранить', ["class"=>'btn btn-primary col-md-offset-3']) !!}


						</div>

			{!!Form::close()!!}
		
		</div>

</div>


@endsection