

@extends('layouts.master')

@section ('content')

@include('layouts.tours2_create_table')

<script type="text/javascript" src="{{ URL::asset('js/add_passenger.js') }}"</script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour_ajax.js') }}"></script>

@endsection



