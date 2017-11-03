@extends('layouts.master')

@section ('content')

<div class="container-fluid">

	@if($files = Storage::allFiles('/public/contracts_'.$id.'/docx'))

		@foreach ($files as $file)

			@php 

			$link = str_replace('public/', '', $file);

			$link = '/download/'.$link;

			@endphp

		<a href="{{ URL::asset($link) }}" target="_blank">Документ</a>

		@endforeach


	@endif

</div>

@endsection