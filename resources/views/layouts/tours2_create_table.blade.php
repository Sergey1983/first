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
				


				<span>Имя: </span><input type="text" name="name[]" placeholder="Имя"><br><br>
				<span>Фамилия: </span><input type="text" name="lastName[]" placeholder="Фамилия"><br><br>	
				<span>Дата рождения: </span><input type="date" name="birth_date[]" value="" placeholder="Дата рождения"><br><br>

				<br><br>
				<span>Имя: </span><input type="text" name="name[]" placeholder="Имя"><br><br>
				<span>Фамилия: </span><input type="text" name="lastName[]" placeholder="Фамилия"><br><br>	
				<span>Дата рождения: </span><input type="date" name="birth_date[]" value="" placeholder="Дата рождения"><br><br>
				
				<input type="submit" value="Создать тур">

			</form>





