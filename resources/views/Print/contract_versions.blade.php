@extends('layouts.master')

@section ('content')

<div class="container-fluid margin-top-25">

	<div class="col-md-12 text-center margin-bottom-10">
		
		<h3>История документов. Заявка {{$tour->id}}. Продукт {{$tour->tour_type}}</h3>

	</div>


	<div class="col-md-12">

	<table class="table table-striped table-hover table-responsive no-margin-bottom">

		<thead>

			<tr>

				<th>Дата создания</th>

				<th>Тип</th>

				<th>Id документа</th>

				<th>Версия заявки</th>

				<th>Скачать</th>

			</tr>

		</thead>


		@if($contract_versions === 'У тура еще нет документов') 

			<tr><td colspan = "3" style="color:red" class="text-center">У тура еще нет документов!</td></tr>

		@else 

			@foreach ($contract_versions as $contract)
			

				<tr>

					<td>{{$contract->created_at}}</td>
					<td>{{$contract->doc_type}}</td>
					<td>{{$contract->id}}</td>
					<td>

						<a href="{{route('tour.versions', ['tour' => $contract->tour_id])}}/#version{{$contract->tour_version}}">{{$contract->tour_version}}</a>
						
{{-- 						<a href="{{ URL::asset('tours/'.$contract->tour_id.'/versions#version'.$contract->tour_version ) }}">{{$contract->tour_version}}</a> --}}

					</td>
					<td>

						<a href="{{route('contract.download', ['tour' => $contract->tour_id, 'filename' => $contract->filename])}}">

							{{$contract->filename}}

						</a>

{{-- 						<a href="{{ URL::asset('download/'.$contract->tour_id.'/'.$contract->filename) }}" target="_blank">{{$contract->filename}}
						</a> --}}

					</td>

				</tr>

			@endforeach

		@endif


{{-- 
		@if($files = Storage::allFiles('/contracts/'.$id))

			@foreach ($files as $file)

				@php 

				$link = str_replace('public/', '', $file);

				$link = '/download/'.$link;

				@endphp

		<tr>

			<td></td>
			<td></td>
			<td><a href="{{ URL::asset($link) }}" target="_blank">{{pathinfo($file)['filename']}}</a></td>

		</tr>

			@endforeach


		@endif --}}

	</table>

	</div>

</div>

@endsection