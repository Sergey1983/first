
@extends('layouts.master')

@section('content')


<div class="container-fluid text-center">

	<div class="col-md-5 col-md-offset-3">

		<h3>Точно решил удалить менеджера?</h3>

	</div>

</div>


<div class="container-fluid margin-bottom-25 text-center">

	<div class="col-md-5 col-md-offset-3">

		<p>
			Менеджер не будет удален, он будет просто сделан неактивным.

		</p>

		<img src="{{ URL::asset('fire-manager.jpg') }}">

	</div>

</div>


<div class="container-fluid text-center">

	<div class="col-md-5 col-md-offset-3">

		{!! Form::open(['id'=>'delete_user', 'class'=>'inline', 'method' => 'POST', 'route' => array('user.destroy', $user) ])!!}

			<div class="form-group text-center">

				{!! Form::submit('Да, нахуй он нужен!', ["id" => "delete_button", "class"=>'btn btn-danger']) !!}

			</div>

		{!! Form::close() !!}

	</div>

</div>



@include('layouts.errors')

@endsection


