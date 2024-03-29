@extends('layouts.master')

@section('content')
{{-- 
<div class="container-fluid text-center margin-bottom-10">
	
	<h3>{{$action}} оператора</h3>

</div> --}}


@php

	$keys = array('name', 'description');

	foreach ($keys as $key) {

		${$key} = $action == 'Создать' ? null : $operator->{$key};

	}

	$route = $action == 'Создать' ? 'operators.store' : ['operators.update', $operator->id];

	$method = $action == 'Создать' ? 'post' : 'put';

@endphp

<div class="container-fluid margin-top-25">

		<div class="col-md-5">
	
			{!!Form::open(['class' =>'form-horizontal', 'route'=> $route, 'method'=>$method])!!}


					 	<div class="form-group">


							{!! Form::label('name', 'Название', ['class'=>'control-label col-md-2'])!!}

							<div class="col-md-10">

						 		{!! Form::text('name', $name, ['placeholder' =>  'Введите название оператора', 'class'=>"form-control"] )  !!}

						 	</div>


						</div>



					 	<div class="form-group">


							{!! Form::label('description', 'Описание', ['class'=>'control-label col-md-2'])!!}

							<div class="col-md-10">

						 		{!! Form::textarea('description', $description, ['placeholder' =>  'Введите описание оператора', 'class'=>"form-control", 'rows'=>15, 'cols'=> 20] )  !!}

						 	</div>


						</div>


						<div class="form-group">

							{!! Form::submit('Сохранить', ["class"=>'btn btn-primary col-md-offset-6']) !!}


						</div>

			{!!Form::close()!!}
		
		</div>

</div>


@endsection