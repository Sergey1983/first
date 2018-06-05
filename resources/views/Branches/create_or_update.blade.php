@extends('layouts.master')

@section('content')
{{-- 
<div class="container-fluid text-center margin-bottom-10">
	
	<h3>{{$action}} оператора</h3>

</div> --}}


@php

	$keys = array('name', 'details');

	foreach ($keys as $key) {

		${$key} = $action == 'Создать' ? null : $branch->{$key};

	}

	$route = $action == 'Создать' ? 'branches.store' : ['branches.update', $branch->id];

	$method = $action == 'Создать' ? 'post' : 'put';

@endphp

<div class="container-fluid margin-top-25">

		<div class="col-md-5">
	
			{!!Form::open(['class' =>'form-horizontal', 'route'=> $route, 'method'=>$method])!!}


					 	<div class="form-group">


							{!! Form::label('name', 'Название', ['class'=>'control-label col-md-2'])!!}

							<div class="col-md-10">

						 		{!! Form::text('name', $name, ['placeholder' =>  'Введите название филиала', 'class'=>"form-control"] )  !!}

						 	</div>


						</div>



					 	<div class="form-group">


							{!! Form::label('details', 'Реквизиты', ['class'=>'control-label col-md-2'])!!}

							<div class="col-md-10">

						 		{!! Form::textarea('details', $details, ['placeholder' =>  'Введите реквизиты филила', 'class'=>"form-control", 'rows'=>15, 'cols'=> 20] )  !!}

						 	</div>


						</div>


						<div class="form-group">

							{!! Form::submit('Сохранить', ["class"=>'btn btn-primary col-md-offset-6']) !!}


						</div>

			{!!Form::close()!!}
		
		</div>

</div>


@endsection