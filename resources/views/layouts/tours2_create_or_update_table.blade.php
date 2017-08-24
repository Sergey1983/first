
<div class="container-fluid">

	<div class="row">

		<h2 class='col-md-12 text-center'>Конструктор пакетного тура</h2>

	</div>

</div>

<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<h3>Описание тура:</h3>

		</div>

	</div>


		{!! 
			Form::macro('buttonSearch', function($value, $id, $type=null) {
		    return "<button $type id='$id' class='btn btn-default'>$value<span class='glyphicon glyphicon-search'></span></button>";
			});

		 !!}

	<div class="row">
		
		<div class="col-md-12">

			<div class="tour padding">

				{!!Form::open(['id' => 'tour_form', 'class' =>'form-horizontal'])!!}

				<div class="form-group">

					{!! Form::label('сity_from', 'Город отправления', ['class'=>'control-label col-md-2'])!!}

					<div class="col-sm-3">

				 		{!! Form::select('сity_from', $cities, null, ['placeholder' =>  'Выберите город', 'class'=>"form-control"] )  !!}

				 	</div>

				</div>

			 	<div class="form-group">

					{!! Form::label('hotel', 'Отель', ['class'=>'control-label col-md-2'])!!}

					<div class="col-sm-3">	

						{!! Form::text('hotel', null, ['placeholder' => 'Введите отель', 'class'=>"form-control"]) !!}

					</div>
				
				</div>

				{!!Form::close()!!}

			</div>

		</div>

	</div>

</div>


<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<h3>Туристы:</h3>

		</div>

		<div class="col-md-12">

			{!! Form::open(['id' => 'find_passengers', 'class' => 'form-inline'])!!}

			<div class="form-group">

				{!! Form::label('tour', 'Вставить туристов из заявки №:')!!}
				{!! Form::text('tour', null, ['class'=>'form-control']) !!}

			</div>

			<div class="form-group">

				{!! Form::buttonSearch('Загрузить ', 'submit_find_passengers') !!}

			</div>

			{!! Form::close()!!}

		</div>

	</div>


	<div class="row">


		<div class="col-md-12">

			{!! Form::open(['id' => 'passengers_form', 'class'=>'form-horizontal'] ) !!}



			{!! Form::hidden ('cannot_change_old_tourists', 'true')!!}
			{!! Form::hidden ('tour_exists')!!}
			{!! Form::hidden ('is_update', $is_update)!!}



			<div class="inputs_0 padding">

				<div class='form-group'>
					{!! Form::label('name[0]', 'Имя', ['class'=>'control-label col-md-1'])!!}
					
					<div class="col-md-3">
						{!! Form::text ('name[0]', null, ['placeholder' => 'Имя', 'class'=>'form-control'])!!}
					</div>

				</div>


				<div class='form-group'>
					{!! Form::label('lastName[0]', 'Фамилия', ['class'=>'control-label col-md-1'])!!}
					
					<div class="col-md-3">
						{!! Form::text ('lastName[0]', null, ['placeholder' => 'Фамилия', 'class'=>'form-control'])!!}
					</div>

				</div>


				<div class='form-group'>
					{!! Form::label('birth_date[0]', 'Дата рождения', ['class'=>'control-label col-md-1'])!!}

					<div class="col-md-3">
					{!! Form::date ('birth_date[0]', null, ['placeholder' => 'Дата рождения', 'class'=>'form-control'])!!}
					</div>

				</div>


				<div class='form-group'>
					{!! Form::label('doc_fullnumber[0]', 'Номер паспорта', ['class'=>'control-label col-md-1'])!!}

					<div class="col-md-3">
						{!! Form::text ('doc_fullnumber[0]', null, ['placeholder' => 'Номер паспорта', 'class'=>'form-control'])!!}
					</div>

					{!! Form::buttonSearch('Проверить ', 'check_doc') !!}


				</div>


				<div class='form-group' id='payer'>
					{!! Form::label('Заказчик?', null, ['class'=>'control-label col-md-1'])!!}

					<div class="col-md-3">
						{!! Form::radio ('is_buyer', '0')!!}
					</div>
				</div>


			</div>
			
			<div class='input'>
					{!! Form::button('+Еще турист', ['id' => 'add_passenger', 'class' => 'inline btn btn-default']) !!}
			</div>

			
			<div class='input submit'>
				{!! Form::submit( $verb.=' тур', ['id' => $button, 'class' => 'inline btn btn-success']) !!}
			</div>

			{!! Form::close()!!}

		</div>

	</div>

</div>

