@extends('layouts.master')

@section ('content')


<div class="container-fluid">

	@include('Statistics.statistics_filter')
	@include('Statistics.statistics_table')

</div>

<script type="text/javascript" src="{{ URL::asset('js/statistics/load_statistics.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/load_tours/tooltip.js') }}"></script>


@endsection