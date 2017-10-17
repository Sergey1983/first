@extends('layouts.master')

@section ('content')


{{-- @for ($i=0; $i<count($versions); $i++) 
 --}}

<div class="container-fluid">


@php

	// dd($versions);

    $version_indexes = $versions->pluck('this_version')->unique()->toArray();

    $version_indexes = array_values($version_indexes);

@endphp

	<ul class="nav nav-tabs">

		@foreach ($version_indexes as $version) 

			<li><a data-toggle="tab" @if ($version==1) class="active" @endif href="#version{{$version}}">Версия {{$version}}</a></li>

		@endforeach



	</ul>

	
	<div class="tab-content">

		@foreach ($version_indexes as $version) 


		    <div  @if ($version==1) class="tab-pane fade in active" @else class = "tab-pane fade" @endif id="version{{$version}}">

			  <div>Версия {{$version}} </div>
			  <div>Создана: {{ $versions->where('this_version', $version)->first()->version_created }}</div>

			  @php 

			  	$instance = $versions->where('this_version', $version)->first();

			  	$tour = $instance->previous_tour->first();

			  @endphp


				@include('Tours2.show.tour')



			@php

			  	$tour_tourists_docs = $versions->where('this_version', $version)->all();

			@endphp


				@include('Tours2.show.tourists_and_documents')



			</div>












		@endforeach



	</div>




</div>

{{-- <div class="container-fluid">

	<table class='table table-striped table-hover table-responsive'>
			

				<h3>Версия {{ $versions[$i]['this_version'] }} </h3>

				<div>Создана: {{ $versions[$i]['version_created'] }}</div>
				
				<tr>

				    <th class='col-md-3'>Id заявки</th>
				    <th class='col-md-3'>Вылет из:</th>
				    <th class='col-md-3'>Отель</th>
				    <th class='col-md-3'>Создана менеджером</th>
			  	
			  	</tr>

				<tr>

					<td>{{ $id}}</td>
					<td>{{ $versions[$i]['tour']['city_from'] }}</td>
					<td>{{ $versions[$i]['tour']['hotel'] }}</td>
					<td>{{ $versions[$i]['user'] }}</td>


				</tr>
			
	</table>

</div> --}}



{{-- <div class="container-fluid">

		<table class='table table-striped table-hover table-responsive'>

			<tr>

			    <th>Id туриста</th>
			    <th>Имя</th>
			    <th>Фамилия</th>
			    <th>Дата рождения</th>
			    <th>Номер док-та</th>
			    <th>Покупатель?</th>
			    <th>Турист?</th>
			    
		  	</tr>

		@foreach ($versions[$i]['tourists'] as $tourist)

			<tr>


				<td>{{ $tourist['tourist_id'] }}</td>
				<td>{{ $tourist['name'] }}</td>
				<td>{{ $tourist['lastName'] }}</td>

				<td>{{ date_format($date, 'd-m-Y') }}</td>

{{$date = date_create_from_format('Y-m-d', $tourist['birth_date']) }}

				<td>{{$tourist['is_buyer'] }}</td>	
				<td>{{$tourist['is_tourist'] }}</td>	

			</tr>



		@endforeach

		</table>
		
</div>
 --}}

{{-- @endfor --}}



@endsection