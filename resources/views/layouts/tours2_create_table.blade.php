

		<h1>Конструктор пакетного тура</h1>
			<form id="tour_and_passengers_form" class="inline" method='POST'>

				{{ csrf_field() }}

<br><br>

Описание тура
<br><br>

				<span>Город отправления: </span>
				<select name="сity_from">
					@include('layouts.city_from_list')
				</select><br><br>

				<span>Отель: </span>
				<input type="text" name="hotel" placeholder="Отель"><br><br>


<br><br>
Пассажиры
<br><br>
				
	
			<div class="inputs">

				<label>Имя: </label> <input type="text" name="name[1]" placeholder="Имя" value="{{old('name.1')}}"> <br><br>
				<label>Фамилия: </label><input type="text" name="lastName[1]" placeholder="Фамилия" value="{{old('lastName.1')}}"><br><br>	
				<label>Дата рождения: </label> <input type="date" name="birth_date[1]"  placeholder="Дата рождения" value="{{old('birth_date.1')}}"><br><br>
				<label>Doc number: </label><input type="text" name="doc_fullnumber[1]" placeholder="Doc number" value="{{old('doc_fullnumber.1')}}">
			    <p id="error_1" class="p-error inline"></p>
{{-- 				@if ($errors->has('doc_fullnumber')) <p class="inline">
				{{ $errors->first('doc_fullnumber') }}
				</p>@endif<br><br>	 --}}

			</div>
				
				<button id='add_passenger'>+Еще турист</button>
				<br><br>

				
				<input id="submit_button" type="submit" value="Submit">

			</form>







