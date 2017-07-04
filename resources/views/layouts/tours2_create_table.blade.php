

<h1>Конструктор пакетного тура</h1>


<h2> Описание тура </h2>


	{!!Form::open(['id' => 'tour_form', 'class' =>'inline'])!!}


		{!! Form::label('сity_from', 'Город отправления')!!}
		{!! Form::select('сity_from', $cities, isset($tour->сity_from) ? $tour->сity_from : null, ['placeholder' =>  'Выберите город'] )  !!}


		{!! Form::label('hotel', 'Отель')!!}
		{!! Form::text('hotel', null, ['placeholder' => 'Выберите отель']) !!}


	{!!Form::close()!!}




<h2> Туристы </h2>

	{!! Form::open(['id' => 'find_passengers', 'class' => 'inline'])!!}


		{!! Form::label('tour', 'Вставить туристов из заявки №:')!!}
		{!! Form::text('tour') !!}
		{!! Form::submit('Загрузить', ['id' => 'submit_find_passengers']) !!}

	{!! Form::close()!!}


<br>
		{!! Form::open(['id' => 'passengers_form', 'class' => 'inline' ] ) !!}

		<div class="inputs_0 padding">

			<div class='input'>
				{!! Form::label('name[0]', 'Имя')!!}
				{!! Form::text ('name[0]', null, ['placeholder' => 'Имя'])!!}
			</div>


			<div class='input'>
				{!! Form::label('lastName[0]', 'Фамилия')!!}
				{!! Form::text ('lastName[0]', null, ['placeholder' => 'Фамилия'])!!}
			</div>


			<div class='input'>
				{!! Form::label('birth_date[0]', 'Дата рождения')!!}
				{!! Form::date ('birth_date[0]', null, ['placeholder' => 'Дата рождения'])!!}
			</div>


			<div class='input'>
				{!! Form::label('doc_fullnumber[0]', 'Номер паспорта')!!}
				{!! Form::text ('doc_fullnumber[0]', null, ['placeholder' => 'Номер паспорта'])!!}
				{!! Form::button('Проверить!', ['class' => 'check_doc']) !!}
			</div>


			<div class='input'>
				{!! Form::label('Заказчик?')!!}
				{!! Form::radio ('is_buyer', '0')!!}
			</div>


		</div>

		
		<div class='input'>
				{!! Form::button('+Еще турист', ['id' => 'add_passenger', 'class' => 'inline']) !!}
		</div>

		
		<div class='input'>
			{!! Form::submit('Создать тур', ['id' => 'submit_button']) !!}
		</div>
		{!! Form::close()!!}

{{-- 

<h1>Конструктор пакетного тура</h1>


<h2> Описание тура </h2>


	<form id="tour_form" class="inline" method='POST'>



		<label>Город отправления: </label>

			<select name="сity_from">

				@include('layouts.city_from_list')
			
			</select><br><br>

		<label>Отель: </label>
		
		<input type="text" name="hotel" placeholder="Отель">

		<br><br>

	</form> 



<h2> Туристы </h2>


	<form id="find_passengers" class="inline">
		

		<label>Вставить туристов из заявки №: </label>

		<input type="text" name="tour">
		
		<input id="submit_find_passengers" type="submit" value="Загрузить">

	</form>

	

	<form id="passengers_form" method="POST" action='/tours_2/create' class="inline">
		
		
		<div class="inputs_0 padding">

			<label>Имя: </label> 
			<input type="text" name="name[0]" placeholder="Имя">

			<br><br>

			<label>Фамилия: </label>
			<input type="text" name="lastName[0]" placeholder="Фамилия">

			<br><br>	

			<label>Дата рождения: </label> 
			<input type="date" name="birth_date[0]"  placeholder="Дата рождения">

			<br><br>

			<label>Doc number: </label>
			<input type="text" name="doc_fullnumber[0]" placeholder="Doc number" >
			<button type="button" class="check_doc"> Проверить? </button> 



			<br><br>
			
			<label>Заказчик?: </label>
			<input type="radio" name="is_buyer" value="0">

			<br><br>
			
			<button type="button" class="delete_passenger"> Удалить туриста? </button> 

		</div>



		<button id='add_passenger' class='inline'>+Еще турист</button>

		<br><br>

		
		<input id="submit_button" type="submit" value="Отправить">

	</form> --}}



