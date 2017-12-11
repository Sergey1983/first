@extends('layouts.master')

@section('content')

<div class="container-fluid">
	
	<div class="row margin-bottom-25">

			{!! Form::open(['method'=> "get", 'route' => ['airports.index']]) !!}


		<div class="col-md-2">

			{!! Form::select('country', $countries, null, ['placeholder'=>'Выберите страну', 'class'=>"form-control"])!!}

			
		</div>

		<div class="col-md-2">

			{!!Form::submit('Показать по стране', ['class' => 'btn btn-default'])!!}
	
			
		</div>

			{!! Form::close() !!}


		<div class="col-md-1 col-md-offset-6">

			<a href="{{route('airports.create')}}" class="btn btn-success no-margin" role="button">Создать аэропорт</a>

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
				<th class="text-center">Популярность по стране<th>
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
				<td class="text-center">{{$airport->popularity}}<td>
				<td><a href="{{route('airports.edit', ['id'=>$airport->id])}}"  role="button">Редактировать</a><td>

			</tr>
			
		@endforeach
			
		</tbody>


	</table>


	{{$airports->links()}}
</div>

@endsection