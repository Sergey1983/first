@extends('layouts.master')

@section('content')


<br><br>


		<h1>Создать тур</h1>
			<form method='POST'>

				{{ csrf_field() }}
				<input type="text" name="name" placeholder="Имя "><br><br>
				<input type="text" name="lastName" placeholder="Фамилия"><br><br>
				<input type="text" name="nameEng" placeholder="Имя Eng"><br><br>
				<input type="text" name="lastNameEng" placeholder="Фамилия Eng"><br><br>
				<select name="destination">
						@include('layouts.destinations')
				</select><br><br>

				<input type="date" name="departure" value="2017-04-01" placeholder="Дата вылета"><br><br>
			
				<input type="submit" value="Создать тур">

			</form>



@endsection