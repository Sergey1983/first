@extends('layouts.master')

@section ('content')

@include('layouts.tours2_show_table')


<div class="container-fluid">

	@include('layouts.button_edit_tour')

	@if($is_versions == 1) 
		
		@include('layouts.button_versions_tour')	

	@endif

</div>


@endsection