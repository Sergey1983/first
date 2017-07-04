

@extends('layouts.master')

@section ('content')

@include('layouts.tours2_edit_table')


<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_passenger.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/edit_tour/update_tour.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/find_passengers.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/delete_passengers.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/is_tourist.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/check_doc.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/edit_tour/get_tour_id.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/edit_tour/edit_tour_load_parameters.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_passenger_from_response.js') }}"></script>

@endsection



