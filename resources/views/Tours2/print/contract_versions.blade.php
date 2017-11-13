@extends('layouts.master')

@section ('content')

<div class="container-fluid">

	<table class="table table-striped table-hover table-responsive no-margin-bottom">

		<thead>

			<tr>

				<th>Дата создания</th>

				<th>Тип</th>

				<th>Версия по типу док-та</th>

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
					<td>{{$contract->contract_type}}</td>
					<td>{{$contract->version_by_type}}</td>
					<td>{{$contract->tour_version}}</td>
					<td><a href="{{ URL::asset($contract->filename) }}" target="_blank">{{$contract->filename}}</a></td>

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

@endsection