
@extends('layouts.master')

@section('content')


<div class="container-fluid">

	<div class="col-md-12">

		<h3>Список менеджеров</h3>

	</div>

</div>


<div class="container-fluid margin-bottom-10px">

	<div class="col-md-12">


		{!! Form::open(['id'=>'create_user', 'class'=>'inline', 'method'=>'get', 'route'=>array('user.create')])!!}

		{!! Form::submit('Создать менеджера', ['class'=>'btn btn-primary']) !!}

		{!! Form::close() !!}

	</div>

</div>

<div class="container-fluid">

	<div class="col-md-12">

		<table class="table table-responsive table-bordered table-striped col-md-12">
		
			<tr>
		    <th>Id менеджера</th>
		    <th>Имя:</th>
		    <th>Email</th>
		    <th></th>
		  	</tr>

		@foreach ($users as $user)

			<tr>

			<td><?= $user->id ?></td>
			<td><?= $user->name ?></td>
			<td><?= $user->email ?></td>
			<td><a href="{{route('user.edit', $user->id)}}">Редактировать</a></td>
			</tr>



		@endforeach

</div>

</div>

@include('layouts.errors')

@endsection


