@extends('layouts.master')

@section ('content')

@include('tours2.show.tours2_show_table')


<div class="container-fluid">

	<div class="row">
		
		@include('layouts.button_edit_tour')

		@include('layouts.button_contract_preview')

		@if($is_versions == 1) 
			
			@include('layouts.button_versions_tour')	

		@endif

		@if($tour->contracts->count() > 0) 
			
			@include('layouts.button_versions_contract')	

		@endif

	</div>
</div>


@endsection