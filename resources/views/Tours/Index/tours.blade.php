@extends('layouts.master')

@section ('content')


<div class="container-fluid">

	@include('Tours.Index.tours_filters')
	@include('Tours.Index.tours_table')

</div>

<script type="text/javascript" src="{{ URL::asset('js/load_tours/load_tours.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/load_tours/tooltip.js') }}"></script>


@endsection



