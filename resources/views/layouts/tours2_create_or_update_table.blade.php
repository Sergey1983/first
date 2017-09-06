
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

			<div class="tour padding col-md-12">

			{!!Form::open(['id' => 'tour_form', 'class' =>'form-horizontal'])!!}

				<div class="col-md-6">
					

						<div class="form-group">

							{!! Form::label('city_from', 'Город отправления', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('city_from', $cities, null, ['placeholder' =>  'Выберите город', 'class'=>"form-control", 'id'=>'city_from'] )  !!}

						 	</div>
							
						</div>

						<div class="form-group">

							{!! Form::label('country', 'Cтрана пребывания', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('country', $countries, null, ['placeholder' =>  'Выберите страну', 'class'=>"form-control", 'id'=>'country'] )  !!}

						 	</div>
							
						</div>

					 	<div class="form-group">
							
							{!! Form::label('airport', 'Аэропорт прибытия', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('airport', [0=>'Сначала выберите страну'], null, ['class'=>"form-control", 'id'=>'airport'] )  !!}

						 	</div>

						</div>

					 	<div class="form-group">
							
							{!! Form::label('operator', 'Туроператор', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('operator', $operators, null, ['placeholder' =>  'Выберите оператора', 'class'=>"form-control", 'id'=>'operator'] )  !!}

						 	</div>

						</div>

					 	<div class="form-group">
							
							{!! Form::label('nights', 'Ночей', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('nights', $nights, null, ['placeholder' =>  'Выберите ночей', 'class'=>"form-control", 'id'=>'nights'] )  !!}

						 	</div>

						</div>

					 	<div class="form-group">
							
								{!! Form::label('date_depart', 'Пребывание с', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">



								{!! Form::date ('date_depart', null, ['class'=>'form-control', 'id'=>'date_depart'])!!}

								<div class="row ">

									<div class="col-md-12 text-right">	
									
									<small>Заселение в отель на день позже {!! Form::checkbox ('date_hotel', 1, false, ['id'=>'date_hotel'])!!}</small>

									</div>

								</div>


						 	</div>

						</div>

					 	<div class="form-group">


							{!! Form::label('hotel', 'Отель', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">	

								{!! Form::text('hotel', null, ['placeholder' => 'Введите отель', 'class'=>"form-control", 'id'=>'hotel', 'required']) !!}

							</div>

						</div>

					 	<div class="form-group">

							{!! Form::label('room', 'Тип номера', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">	

								{!! Form::text('room', null, ['placeholder' => 'Тип номера', 'class'=>"form-control", 'id'=>'room']) !!}

								<div class="row ">

									<div class="col-md-12 text-right">	
									
										<small>Ввести больше одного номера {!! Form::checkbox ('add_rooms', 1, false, ['id'=>'add_rooms'])!!}</small>

									</div>

								</div>

							</div>

						</div>


					 	<div class="form-group">

							{!! Form::label('food_type', 'Питание', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">	

								{!! Form::select('food_type', $food_type, null, ['placeholder' => 'Тип питания', 'class'=>"form-control", 'id'=>'food_type']) !!}


								<div class="row">

									<div class="col-md-12 text-right">	
									
										<small>Ввести другой тип питания {!! Form::checkbox ('change_food_type', 1, false, ['id'=>'change_food_type'])!!}</small>

									</div>

								</div>

							</div>

						</div>


					 	<div class="form-group">
							
							{!! Form::label('currency', 'Валюта тура', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('currency', $currency, null, ['placeholder' =>  'Валюта тура', 'class'=>"form-control", 'id'=>'currency'] )  !!}

						 	</div>

						</div>


					 	<div class="form-group" id="price">


							{!! Form::label('price', 'Стоимость тура в валюте', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::text('price', null, ['placeholder' =>  'Введите ст-ть в валюте', 'class'=>"form-control", 'id'=>'price'] )  !!}

						 	</div>

						</div>

					 	<div class="form-group" id="price_rub">


							{!! Form::label('price_rub', 'Стоимость в рублях', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::text('price_rub', null, ['placeholder' =>  'Округляйте сумму', 'class'=>"form-control", 'id'=>'price_rub'] )  !!}

								<div class="row ">

									<div class="col-md-12 text-right">	
									
									<small>Тур преобретается в кредит {!! Form::checkbox ('is_credit', 1, false, ['id'=>'is_credit'])!!}</small>

									</div>

								</div>

						 	</div>

						</div>
				

				</div>



				<div class="col-md-6">
					

						<div class="form-group">

						 	{!! Form::label('transfer', 'Трансфер', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

								{!! Form::select('transfer', $transfer , null, ['placeholder' => 'Выберите тип', 'class'=>"form-control", 'id'=>'transfer']) !!}

						 	</div>
							
						</div>

						<div class="form-group" id='noexit_insurance_form_group'>

							{!! Form::label('noexit_insurance', 'Страховка от невыезда', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8" id="noexit_insurance_div">

								{!! Form::select('noexit_insurance', $noexit_insurance , null, ['placeholder' => 'Выберите тип', 'class'=>"form-control", 'id'=>'noexit_insurance']) !!}

						 	</div>
							
						</div>


						<div class="form-group">

							{!! Form::label('med_insurance', 'Мед. страховка', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

								{!! Form::select('med_insurance', $med_insurance, null, ['placeholder' => 'Выберите', 'class'=>"form-control", 'id'=>'med_insurance']) !!}

						 	</div>

						</div>

						<div class="form-group" id='visa_form_group'>


							{!! Form::label('visa', 'Оформление визы', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8" id="visa_div">

								{!! Form::select('visa', $visa, null, ['placeholder' => 'Выберите', 'class'=>"form-control", 'id'=>'visa']) !!}

						 	</div>

						</div>

						<div class="form-group">


							{!! Form::label('sightseeing', 'Экскурсия', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

								{!! Form::text('sightseeing', 'Нет', ['class'=>"form-control", 'id'=>'sightseeing', 'readonly'=>'readonly']) !!}

								<div class="row">

									<div class="col-md-12 text-right">	
									
										<small>Ввести экскурсию {!! Form::checkbox ('change_sightseeing', 1, false, ['id'=>'change_sightseeing'])!!}</small>

									</div>

								</div>

						 	</div>

						</div>



						<div class="form-group">

							{!! Form::label('extra_info', 'Допольнительные услуги', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">


						 		{!! Form::textarea('extra_info', null, ['placeholder' =>  'Введите текст', 'class'=>"form-control", 'id'=>'extra_info'] )  !!}


						 	</div>

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

					{!! Form::buttonSearch('Найти по паспорту', 'check_doc') !!}


				</div>


				<div class='form-group' id='payer'>
					{!! Form::label('Заказчик?', null, ['class'=>'control-label col-md-1'])!!}

					<div class="col-md-3">
						{!! Form::radio ('is_buyer', 0)!!}
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



<script type="text/javascript">



function randomselect(name) {

		var length = $('#'+name+'').find('option').length;
	    var value = Math.floor(Math.random() * (length - 2 + 1)) + 1;
	    value++;
	    $('#'+name+'').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');



};


$('select').each(function () {
	randomselect(this.name);
})



function text(j) {
  var text = "";
  var possible = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя0123456789 ";


  for (var i = 0; i < j; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}


function randomtext(name, j) {
	$('#'+name+'').val(text(j));
}





$('[type="text"]').each(function () {
	randomtext(this.name, 5);
})

$('textarea').each(function () {
	randomtext(this.name, 200);
})

$('[name="price"]').val('700');


setTimeout(country, 1000);
setTimeout(currency, 1000);
setTimeout(airport, 2000);



function currency(){
	    var value = Math.floor(Math.random() * (2 - 1 + 1)) + 1;
	    value++;
	    $('#currency').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');
	    $('input[id$="price_rub"]').val($('input[id$="price"]').val());
	    return false;
	};

function country(){
	    var value = Math.floor(Math.random() * (20 - 1 + 1)) + 1;
	    value++;
	    $('#country').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');
	    return false;
	};

function airport() {
	setTimeout($('#airport').find('option:nth-child(' + 3 + ')').prop('selected',true).trigger('change'), 2000);

}



// random('transfer');

// var data = {
city_from
operator
nights
date_depart
date_hotel
hotel
room
food_type
currency
price
price_rub
transfer
noexit_insurance
med_insurance
visa
extra_info












</script>


