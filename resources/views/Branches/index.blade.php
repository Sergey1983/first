@extends('layouts.master')

@section('content')

<div class="container-fluid margin-top-25">
	
	<div class="row margin-bottom-25">



		<div class="col-md-1">

			<a href="{{route('branches.create')}}" class="btn btn-success no-margin" role="button">Создать филиал</a>

		</div>

	</div>


</div>

<div class="container-fluid">
	
	<table class="table table-responsive">
		
		<thead>

			<tr>

				<th class="col-md-2">Название</th>
				<th>Реквизиты</th>


			</tr>

		</thead>

		<tbody>

		@foreach ($branches as $branch)

			<tr>

				<td>{{$branch->name}}</td>
				<td>{{$branch->details}}</td>

				<td><a href="{{route('branches.edit', ['id'=>$branch->id])}}"  role="button">Редактировать</a><td>

			</tr>
			
		@endforeach
			
		</tbody>


	</table>


</div>

@endsection