@if($errors->has())
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif

		<h1>Конструктор пакетного тура</h1>
			<form class="inline" method='POST'>

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

				<span>Имя: </span><input type="text" name="name[]" placeholder="Имя"><br><br>
				<span>Фамилия: </span><input type="text" name="lastName[]" placeholder="Фамилия"><br><br>	
				<span>Дата рождения: </span><input type="date" name="birth_date[]" value="" placeholder="Дата рождения"><br><br>
				<span>Номер док-та: </span><input type="text" name="doc_fullnumber[]" placeholder="Номер док-та"><br><br>	


			</div>
				
				<button id='add_passenger'>+1 пассажир</button>
				<br><br>

				
				<input type="submit" value="Создать тур">

			</form>







