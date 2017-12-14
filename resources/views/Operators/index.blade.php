@extends('layouts.master')

@section('content')

<div class="container-fluid margin-top-25">
	
	<div class="row margin-bottom-25">

{{-- 			{!! Form::open(['method'=> "get", 'route' => ['airports.index']]) !!}


		<div class="col-md-2">

			{!! Form::select('country', $countries, null, ['placeholder'=>'Выберите страну', 'class'=>"form-control"])!!}

			
		</div>

		<div class="col-md-2">

			{!!Form::submit('Показать по стране', ['class' => 'btn btn-default'])!!}
	
			
		</div>

			{!! Form::close() !!} --}}


		<div class="col-md-1">

			<a href="{{route('operators.create')}}" class="btn btn-success no-margin" role="button">Создать оператора</a>

		</div>

	</div>


</div>

<div class="container-fluid">
	
	<table class="table table-responsive">
		
		<thead>

			<tr>

				<th>Название</th>
				<th>Описание</th>


			</tr>

		</thead>

		<tbody>

		@foreach ($operators as $operator)

			<tr>

				<td>{{$operator->name}}</td>
				<td>{{$operator->description}}</td>

				<td><a href="{{route('operators.edit', ['id'=>$operator->id])}}"  role="button">Редактировать</a><td>

			</tr>
			
		@endforeach
			
		</tbody>


	</table>


	{{$operators->links()}}
</div>

@endsection