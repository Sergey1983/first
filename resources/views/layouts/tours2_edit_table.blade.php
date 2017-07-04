<h1>Редактировать тур №</h1>


<h2> Описание тура </h2>


	{!!Form::open(['id' => 'tour_form', 'class' =>'inline'])!!}


		{!! Form::label('сity_from', 'Город отправления')!!}
		{!! Form::select('сity_from', $cities, isset($tour->сity_from) ? $tour->сity_from : null, ['placeholder' =>  'Выберите город'] )  !!}


		{!! Form::label('hotel', 'Отель')!!}
		{!! Form::text('hotel', null, ['placeholder' => 'Выберите отель']) !!}


	{!!Form::close()!!}




<h2> Туристы </h2>

{{-- 	{!! Form::open(['id' => 'find_passengers', 'class' => 'inline'])!!}


		{!! Form::label('tour', 'Вставить туристов из заявки №:')!!}
		{!! Form::text('tour') !!}
		{!! Form::submit('Загрузить', ['id' => 'submit_find_passengers']) !!}

	{!! Form::close()!!} --}}


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
			{!! Form::submit('Создать тур', ['id' => 'update_button']) !!}
		</div>
		{!! Form::close()!!}