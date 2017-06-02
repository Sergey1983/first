@extends('layouts.master')

@section('content')

	<form id="search-form" method="get">
						
						{{ csrf_field() }}



<table>





		<tr>

			<td style="width:30%">

			<h1>Сортировать по стране</h1> 



						<select id="destination"  name="destination" class="input">
							
						@include('layouts.destinations')

						</select>



			</td>

			<td>

			<h1>Сортировать по дате вылета</h1> 


						<span>От: </span><input type="date" name="from" id="from" class="input">

						<span>До: </span><input type="date" name="to" id="to" class="input"><br><br>
					

			</td>

			<td>
				
				
				<h1>Сортировать по имени</h1> 

				<input type="type" name="name" id="name" placeholder="имя или фамилию, pls" class="input">

			</td>

		</tr>


		<tr>
			<td colspan="3">

				<br>
				
				<input type="submit" value="Применить" id="filter">
				<button type="reset" id="filter-reset">Отменить все </button>

				<br>
				<br>

			</td>

		</tr>


</table>

</form>


<h1>Список туров</h1>



<table class="sortable repaginate">

			<thead>

				<tr>
				    <th class='sort-numeric'>Id заявки</th>
				    <th>Имя</th>
				    <th>Фамилия</th>
				    <th>Имя (Eng)</th>
				    <th>Фамилия (Eng)</th>
				    <th>Куда летит</th>
				    <th class='sort-date'>Дата вылета</th>
				    <th></th>
			  	</tr>

			</thead>

  

			<tbody id="tours_table" class="tbody_sort_paginate">



			</tbody>





</table>


 
		
<script type="text/javascript" src="{{ URL::asset('js/tours_load_filter.js') }}"></script>
{{-- <script type="text/javascript" src="{{ URL::asset('js/sort_paginate.js') }}"></script> --}}



</script>

@endsection
