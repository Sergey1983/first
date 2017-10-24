@extends('layouts.master')

@section ('content')


<div class="container-fluid">

	@include('layouts.create_tour_button')

		@if (auth()->user()->id == 1)


		@include('layouts.admin_panel_button')


		@endif

</div>

@include('layouts.tours2_table')

<script type="text/javascript" src="{{ URL::asset('js/load_tours/load_tours.js') }}"></script>


@endsection



