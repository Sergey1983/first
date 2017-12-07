@extends('layouts.master')

@section('content')

<div class="container-fluid">
	
	<div class="row">

			{!! Form::open(['method'=> "get", 'route' => ['airports.index']]) !!}

		<div class="col-md-1">

			{!! Form::label('country', 'Страна', ['class'=>'control-label col-md-4 no-padding'])!!}

		</div>

		<div class="col-md-2 no-padding">

			{!! Form::text ('country', null , [ 'class'=>"form-control"])!!}

			
		</div>

		<div class="col-md-2">

			{!!Form::submit('Показать по стране', ['class' => 'btn btn-default'])!!}

	
			
		</div>

			{!! Form::close() !!}

	</div>

	<div class="row margin-bottom-25">

		<div class="col-md-offset-1">

			<small>Вбейте пустое значение и нажмите кнопку, чтобы вывести все</small>
		
		</div>

	</div>

</div>

<div class="container-fluid">
	
	<table class="table table-responsive">
		
		<thead>

			<tr>

				<th>Код</th>
				<th>Название</th>
				<th>Город</th>
				<th>Страна</th>
				<th>Популярность по стране<th>
				<th><th>

			</tr>

		</thead>

		<tbody>

		@foreach ($airports as $airport)

			<tr>

				<td>{{$airport->code}}</td>
				<td>{{$airport->name}}</td>
				<td>{{$airport->city}}</td>
				<td>{{$airport->country}}</td>
				<td>{{$airport->popularity}}<td>
				<td><a href="{{route('airports.show', ['id'=>$airport->id])}}" class="btn btn-info" role="button">Редактировать</a><td>

			</tr>
			
		@endforeach
			
		</tbody>


	</table>


	{{$airports->links()}}
</div>

@endsection