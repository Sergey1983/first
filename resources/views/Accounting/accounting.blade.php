@extends('layouts.master')

@section ('content')


<div class="container-fluid">

	@include('Tours.Index.tours_filters')
	@include('Accounting.accounting_table')

</div>

<script type="text/javascript" src="{{ URL::asset('js/load_tours/load_tours_accounting.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/load_tours/tooltip.js') }}"></script>


@endsection