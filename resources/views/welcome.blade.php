

@extends('layouts.master')

@section('content')



<div class="container-fluid text-center margin-top-25">

{!! Form::open(['id'=>'login', 'class'=>'form-inline', 'method'=>'post', 'route'=>'sessions.login'])!!}


	<div class="text-center margin-bottom-25"> 

		<h3>За работу, друзья!:)</h3>

	</div>

@if($errors->has('message') OR $errors->has('captcha'))

	<div class="row margin-bottom-15">

	  <div class="captcha form-group">

	  	<div class="col-md-12 margin-bottom-5">

	  		<span>{!! captcha_img() !!}</span>

			<button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh">Обновить</i></button>	  		

	  	</div>


	  	<div class="col-md-12">
	  		
			<input id="captcha" type="text" class="form-control" placeholder="Введите капчу" name="captcha">

	  	</div>

	  </div>

	</div>	

@endif

	<div class="row">

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

	</div>




{!! Form::close() !!}

<div class="col-md-4 col-md-offset-4">

@include('layouts.errors')

</div>


</div>

<script type="text/javascript" src="{{ URL::asset('js/captcha/refresh_captcha.js ') }}"></script>



@endsection