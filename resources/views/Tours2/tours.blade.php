@extends('layouts.master')

@section ('content')


@include('layouts.tours2_table')

<script type="text/javascript" src="{{ URL::asset('js/load_tours/load_tours.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/load_tours/tooltip.js') }}"></script>


@endsection



