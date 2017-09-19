<h1>Редактировать тур №</h1>


<h2> Описание тура </h2>


	{!!Form::open(['id' => 'tour_form', 'class' =>'inline'])!!}


		{!! Form::label('city_from', 'Город отправления')!!}
		{!! Form::select('city_from', $cities, ['placeholder' =>  'Выберите город'] )  !!}


		{!! Form::label('hotel', 'Отель')!!}
		{!! Form::text('hotel', null, ['placeholder' => 'Выберите отель']) !!}


	{!!Form::close()!!}




<h2> Туристы </h2>


<br>
		{!! Form::open(['id' => 'passengers_form', 'class' => 'inline' ] ) !!}


		{!! Form::hidden ('cannot_change_old_tourists', 'true')!!}
		{!! Form::hidden ('tour_exists')!!}
		{!! Form::hidden ('is_update', '1')!!}


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
				{!! Form::button('+Еще турист', ['id' => 'add_tourist', 'class' => 'inline']) !!}
		</div>

		
		<div class='input submit'>
			{!! Form::submit('Обновить тур', ['id' => 'update_button']) !!}
		</div>
		{!! Form::close()!!}