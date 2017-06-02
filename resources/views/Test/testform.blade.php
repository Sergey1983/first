@extends('layouts.master')

@section('content')

	<form action='/test3/result' method="get">
						
						{{ csrf_field() }}

<table>


		<tr>

			<td style="width:50%">

			<h1>Сортировать по стране</h1> 



						<select name="destination" id="destination">
							
						@include('layouts.destinations')

						</select>



			</td>

			<td>
				
				
				<h1>Сортировать по имени</h1> 

				<input type="type" name="name" id="name" placeholder="имя или фамилию, pls" class="input">

			</td>

		</tr>


		<tr>
			<td colspan="2">

				<br>
				
				<input type="submit" value="Применить" id="filter-button">

				<br>
				<br>

			</td>

		</tr>


</table>


<h1>Список туров</h1>










@endsection