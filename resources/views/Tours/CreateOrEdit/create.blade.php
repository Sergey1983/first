@extends('layouts.master')

@section ('content')

@include('Tours.CreateOrEdit.create_or_update_table', ['verb' =>'Создать', 'button' =>'submit_button', 'is_update'=> 0])

<script type="text/javascript" src="{{ URL::asset('js/create_tour/initial_functions.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/create_tour/fill_all_fields.js ') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_tourist.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/create_or_update_tour.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/find_passengers.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/delete_passengers.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/is_tourist.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/check_doc.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_tourist_from_response.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/create_tour/airport_load.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_food_type.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_source.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_rooms.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/change_sightseeing.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_price_rub.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/check_return_city.js') }}"></script>

{{-- <script type="text/javascript" src="{{ URL::asset('js/jquery.formautofill.js') }}"></script>
 --}}
 <script type="text/javascript" src="{{ URL::asset('js/create_tour/city_return_add.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_credit.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/visa_add_people.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/noexit_insurance_add_people.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/transliterate.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/change_citezenship.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/choose_doc.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/add_doc.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/mouse_over_dis_docs.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/cancel_patronymic.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/operator_full_pay.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/create_tour/disable_button_for_three_secs.js') }}"></script>


@endsection


