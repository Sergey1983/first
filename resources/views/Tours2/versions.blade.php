@extends('layouts.master')

@section ('content')


{{-- @for ($i=0; $i<count($versions); $i++) 
 --}}

<div class="container-fluid">


	<ul class="nav nav-tabs">


	</ul>

	
		<div class="tab-content">



		</div>


</div>





<script type="text/javascript" src="{{ URL::asset('js/versions/fill_versions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/versions/get_tour_id_for_versions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/versions/get_tour_info_for_versions.js') }}"></script>





@endsection


