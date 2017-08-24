@extends('layouts.master')

@section ('content')


<div class="container-fluid">

	@include('layouts.create_tour_button')

		@if (auth()->user()->id == 1)


		@include('layouts.admin_panel_button')


		@endif

</div>

@include('layouts.tours2_table')

@endsection



