@extends('layouts.master')

@section ('content')


<div class="container-fluid">

	<div class="col-md-8">

		@include('layouts.create_tour_button')
		@include('layouts.create_hotel_tour_button')
		@include('layouts.create_avia_button')

	</div>


		@if (auth()->user()->id == 1)

	<div class="col-md-4 text-right">

		@include('layouts.admin_panel_button')
	
	</div>

		@endif


</div>

@include('layouts.tours2_table')

<script type="text/javascript" src="{{ URL::asset('js/load_tours/load_tours.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/load_tours/tooltip.js') }}"></script>


@endsection



