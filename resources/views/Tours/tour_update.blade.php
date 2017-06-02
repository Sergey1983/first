@extends('layouts.master')

@section('content')


<br><br>


		<h1>Редактировать тур</h1>

		<table>

			<tr>
				<th>Id заявки</th>
			    <th>Имя</th>
			    <th>Фамилия</th>
			    <th>Имя (Eng)</th>
			    <th>Фамилия (Eng)</th>
			    <th>Куда летит</th>
			    <th>Дата вылета</th>

		  	</tr>


			<tr>

				<form method="POST" id="form1">


				{{ csrf_field() }}

					<td><?= $tour->id ?></td>
					<td> <input type="text" name="name" value="<?= $tour->name ?>"> </td>
					<td> <input type="text" name="lastName" value="<?= $tour->lastName ?>"> </td>
					<td> <input type="text" name="nameEng" value="<?= $tour->nameEng ?>"> </td>
					<td> <input type="text" name="lastNameEng" value="<?= $tour->lastNameEng ?>"> </td>
					<td>
							<select  name="destination" value="<?= $tour->destination ?>"> 
								@include('layouts.destinations')
							</select>
					</td>
					<td><input type="date" name="departure" value="<?= $tour->departure ?>"> </td>
				
				</form>

			</tr>


		</table>

		<br><br>
		<a href="/tours" class="a-button">
			<button type="submit" style="background-color:blue; color:white">ОТМЕНА</button>
		</a>
		<button type="submit" form="form1" style="background-color:green; color:white">СОХРАНИТЬ</button>



@endsection