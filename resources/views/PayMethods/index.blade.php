@extends('layouts.master')

@section('content')

<div class="container-fluid margin-top-25">
	
{{-- 	<div class="row margin-bottom-25">
 --}}
		<div class="col-md-1 no-padding-left margin-bottom-25">

			<a href="{{route('pay_methods.create')}}" class="btn btn-success no-margin" role="button">Создать метод оплаты</a>

{{-- 		</div>
 --}}
	</div>


</div>

<div class="container-fluid col-md-6">


	
	<table class="table table-responsive">
		
		<thead>

			<tr>

				<th>Метод оплаты</th>

			</tr>

		</thead>

		<tbody>

		@foreach ($pay_methods_ as $pay_method)

			<tr>

				<td>{{$pay_method->name}}</td>
				<td><a href="{{route('pay_methods.edit', ['id'=>$pay_method->id])}}"  role="button">Редактировать</a><td>

			</tr>
			
		@endforeach
			
		</tbody>


	</table>

{{-- 	@if(!empty($pay_methods))

	{{$pay_methods->appends($_GET)->links()}}

	@endif
 --}}
</div>

@endsection