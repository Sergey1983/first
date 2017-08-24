
@extends('layouts.master')

@section('content')

		<h1>Список менеджеров</h1>

		{!! Form::open(['id'=>'create_user', 'class'=>'inline', 'method'=>'get', 'route'=>array('user.create')])!!}

		{!! Form::submit('Создать менеджера') !!}

		{!! Form::close() !!}

		<br><br>

		<table>
		
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


@include('layouts.errors')

@endsection


