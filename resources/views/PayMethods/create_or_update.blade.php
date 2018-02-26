@extends('layouts.master')

@section('content')



@php

	$keys = array('name');

	foreach ($keys as $key) {

		${$key} = $action == 'Создать' ? null : $pay_method->{$key};

	}

	$route = $action == 'Создать' ? 'pay_methods.store' : ['pay_methods.update', $pay_method->id];

	$method = $action == 'Создать' ? 'post' : 'put';

@endphp

<div class="container-fluid margin-top-25">

		<div class="col-md-5">
	
			{!!Form::open(['class' =>'form-horizontal', 'route'=> $route, 'method'=>$method])!!}




					 	<div class="form-group">


							{!! Form::label('name', 'Название', ['class'=>'control-label col-md-3'])!!}

							<div class="col-md-6">

						 		{!! Form::text('name', $name, ['placeholder' =>  'Введите название метода оплаты', 'class'=>"form-control"] )  !!}

						 	</div>


						</div>



						<div class="form-group  padding-left-14">

							{!! Form::submit('Сохранить', ["class"=>'btn btn-primary col-md-offset-3']) !!}


						</div>

			{!!Form::close()!!}
		
		</div>

</div>


@endsection