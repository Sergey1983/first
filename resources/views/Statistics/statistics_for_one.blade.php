@extends('layouts.master')

@section ('content')



<div class="container-fluid">

	@include('Statistics.statistics_for_one_filter')

	@include('Statistics.statistics_for_one_table')

</div>

@endsection