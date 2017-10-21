
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
			Form::macro('buttonSearch', function($value, $name, $type=null, $disabled=null) {
		    return "<button type=$type name='$name' class='btn btn-default btn-grey' $disabled>$value<span class='glyphicon glyphicon-search'></span></button>";
			});

		 !!}

		{!! 
			Form::macro('selectNonDisabled', function($value, $placeholder, $array, $disabled=null, $class=null) {

				$select  = "<select class='form-control $class' $disabled name='$value'>";

				$select .= "<option selected='selected' hidden='hidden' value=''>$placeholder</option>";

				foreach ($array as $key => $value) {
						
				$select .= "<option value='$key'>$value</option>";

				}

				$select .= "</select>";

		    return $select;

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

						 		@php $airports = isset($tour) ? $tour->country_model->airports_array() : [0=>'Сначала выберите страну'] @endphp

							

						 		{!! Form::select('airport', $airports, null, ['class'=>"form-control", 'id'=>'airport'] )  !!}

						 	</div>

						</div>

					 	<div class="form-group">
							
							{!! Form::label('operator', 'Туроператор', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('operator', $operators, null, ['placeholder' =>  'Выберите оператора', 'class'=>"form-control", 'id'=>'operator'] )  !!}

						 	</div>

						</div>

					 	<div class="form-group">
							
							{!! Form::label('nights', 'Ночей в отеле', ['class'=>'control-label col-md-4'])!!}

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

@php 

	$checked = ( (isset($tour)) && ($tour->date_hotel == 1)) ? true : false

@endphp
									
									<small>Заселение в отель на день позже {!! Form::checkbox ('date_hotel', 1, $checked, ['id'=>'date_hotel'])!!}</small>

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

@php 

	$checked = ( (isset($tour)) && ($tour->add_rooms == 1)) ? true : false

@endphp


@if($checked)

						 		{!! Form::textarea('room', null, ['placeholder' =>  'Введите типы номеров', 'class'=>"form-control", 'id'=>'room', 'rows' => '4'] )  !!}
								

@else

								{!! Form::text('room', null, ['placeholder' => 'Тип номера', 'class'=>"form-control", 'id'=>'room']) !!}

@endif
								<div class="row ">

									<div class="col-md-12 text-right">	

										<small>Ввести больше одного номера {!! Form::checkbox ('add_rooms', 1, $checked, ['id'=>'add_rooms'])!!}</small>

									</div>

								</div>

							</div>

						</div>


					 	<div class="form-group">

							{!! Form::label('food_type', 'Питание', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">	

@php 

	$checked = ( (isset($tour)) && ($tour->change_food_type == 1)) ? true : false

@endphp



@if ($checked)

						 		{!! Form::text('food_type', null, ['placeholder' =>  'Тип питания', 'class'=>"form-control", 'id'=>'food_type'] )  !!}

@else 

								{!! Form::select('food_type', $food_type, null, ['placeholder' => 'Тип питания', 'class'=>"form-control", 'id'=>'food_type']) !!}

@endif
								<div class="row">

									<div class="col-md-12 text-right">	
									
										<small>Ввести другой тип питания {!! Form::checkbox ('change_food_type', 1, $checked, ['id'=>'change_food_type'])!!}</small>

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
@php 

	$checked = ( (isset($tour)) && ($tour->is_credit == 1)) ? true : false

@endphp
									
									<small>Тур преобретается в кредит {!! Form::checkbox ('is_credit', 1, $checked, ['id'=>'is_credit'])!!}</small>

									</div>

								</div>

						 	</div>

						</div>


@if($checked)

						<div class="form-group" id="first_payment">

							<label for="first_payment" class="control-label col-md-4">Первый взнос</label>

							<div class="col-md-8">

								<input placeholder="Введите первый взнос" class="form-control" id="first_payment" name="first_payment" type="text">

							</div>

						</div>


						<div class="form-group" id="bank">

							<label for="bank" class="control-label col-md-4">Первый взнос</label>

								<div class="col-md-8">

									<select class="form-control" id="bank" name="bank">

										<option selected="selected" disabled="disabled" hidden="hidden" value="">Выберите банк</option>

										<option value="ООО Хоум кредит энд финанс банк">ООО Хоум кредит энд финанс банк</option>

										<option value="ООО КБ Ренессанс кредит">ООО КБ Ренессанс кредит</option>

										<option value="ПАО Почта банк">ПАО Почта банк</option>

									</select>

								</div>

						</div>


@endif


					 	<div class="form-group">

							{!! Form::label('source', 'Источник заявки', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">	

@php 

	$checked = ( (isset($tour)) && ($tour->add_source == 1)) ? true : false

@endphp



@if ($checked)

						 		{!! Form::text('source', null, ['placeholder' =>  'Введите источник заявки', 'class'=>"form-control", 'id'=>'source'] )  !!}

@else 

								{!! Form::select('source', $source, null, ['placeholder' => 'Выберите источник заявки', 'class'=>"form-control", 'id'=>'source']) !!}

@endif
								<div class="row">

									<div class="col-md-12 text-right">	
									
										<small>Ввести другой источник {!! Form::checkbox ('add_source', 1, $checked, ['id'=>'add_source'])!!}</small>

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

@php 

	$checked = ( (isset($tour)) && ($tour->noexit_insurance_add_people == 1)) ? 'checked' : null

@endphp

@if(isset($tour))

							<div class="row" id="noexit_insurance_add_people_div">

								<div class="col-md-12 text-right">

									<small> Страховка от невыезда нужна не всем туристам? 

										<input id="noexit_insurance_add_people" name="noexit_insurance_add_people" type="checkbox" value="1" {{$checked}}>

									</small>

								</div>

							</div>

@endif

						 	</div>
							
						</div>

@if($checked)


							<div class="form-group" id="noexit_insurance_people_form_group">

								<div class="col-md-8 col-md-offset-4">

									<textarea rows="4" placeholder="Введите имена туристов, которым нужна услуга" class="form-control" id="noexit_insurance_people" name="noexit_insurance_people">

									</textarea>

								</div>

							</div>

@endif


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
@php 

	$checked = ( (isset($tour)) && ($tour->visa_add_people == 1)) ? 'checked' : null

@endphp


@if(isset($tour))

						<div class="row" id="visa_add_people_div">

							<div class="col-md-12 text-right">

								<small>Виза нужна не всем туристам? <input id="visa_add_people" name="visa_add_people" type="checkbox" value="1" {{$checked}}>

								</small>

							</div>

						</div>


@endif


						 	</div>

						</div>


@if($checked)

						<div class="form-group" id="visa_people_form_group">

							<div class="col-md-8 col-md-offset-4">

								<textarea rows="4" placeholder="Введите имена туристов, которым нужна услуга" class="form-control" id="visa_people" name="visa_people">	

								</textarea>

							</div>

						</div>


@endif

						<div class="form-group">


							{!! Form::label('sightseeing', 'Экскурсия', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

@php 

	$checked = ( (isset($tour)) && ($tour->change_sightseeing == 1)) ? true : false

@endphp


@if(!$checked)

								{!! Form::text('sightseeing', 'Нет', ['class'=>"form-control", 'id'=>'sightseeing', 'readonly'=>'readonly' ]) !!}

@else 

								{!! Form::text('sightseeing', 'Нет', ['class'=>"form-control", 'id'=>'sightseeing']) !!}

@endif


								<div class="row">

									<div class="col-md-12 text-right">	
									
										<small>Ввести экскурсию {!! Form::checkbox ('change_sightseeing', 1, $checked, ['id'=>'change_sightseeing'])!!}</small>

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

		<div class="col-md-12 margin-bottom-10" id="submit_find_passengers">

			{!! Form::open(['id' => 'find_passengers', 'class' => 'form-inline'])!!}

			<div class="form-group">

				{!! Form::label('tour', '№ заявки:')!!}
				{!! Form::text('tour', null, ['class'=>'form-control']) !!}

			</div>

			<div class="form-group">

				{!! Form::buttonSearch('Вставить туристов из заявки', 'submit_find_passengers', 'button') !!}

			</div>

			{!! Form::close()!!}

		</div>

	</div>


	<div class="row">


		<div class="col-md-12">

			{!! Form::open(['id' => 'passengers_form', 'class'=>'form'] ) !!}



			{!! Form::hidden ('allchecked', 'false')!!}
			{!! Form::hidden('all_disabled', 'false') !!}
			{!! Form::hidden ('tour_exists')!!}
			{!! Form::hidden ('is_update', $is_update)!!}



			<div class="inputs_0 padding">

			<div class='row'>

					<div class='form-group col-md-3'>
						{!! Form::label('name[0]', 'Имя', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-8">
							{!! Form::text ('name[0]', null, ['placeholder' => 'Имя', 'class'=>'form-control'])!!}
						</div>

					</div>


					<div class='form-group col-md-3'>
						{!! Form::label('lastName[0]', 'Фамилия', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-8">
							{!! Form::text ('lastName[0]', null, ['placeholder' => 'Фамилия', 'class'=>'form-control'])!!}
						</div>

					</div>

					<div class='form-group col-md-3'>

						<button class='btn btn-default btn-grey col-md-4' id="transliterate_0" type="button" disabled="disabled">Трансл.<span class="glyphicon glyphicon-chevron-right" 
						></span>
						</button>

						<div class="col-md-8">

							{!! Form::text ('nameEng[0]', null, ['placeholder' => 'Imya', 'class'=>'form-control '])!!}

						</div>
						
					</div>

					<div class='form-group col-md-3'>


						<div class="col-md-8 no-padding-left">

							{!! Form::text ('lastNameEng[0]', null, ['placeholder' => 'Familiya', 'class'=>'form-control'])!!}

						</div>

					</div>


			</div>

			<div class='row'>


				<div class='form-group col-md-3 no-margin-bottom '>

					{!! Form::label('birth_date[0]', 'Дата рождения', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

					{!! Form::date ('birth_date[0]', null, ['placeholder' => 'Дата рождения', 'class'=>'form-control'])!!}
					
					</div>

				</div>

				<div class='form-group col-md-3 no-margin-bottom'>

					{!! Form::label('citizenship[0]', 'Гражданство', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

					{!! Form::select('citizenship[0]', ['Россия'=>'Россия'], null, ['class'=>"form-control", 'id'=>'citizenship[0]']) !!}

						<div class="row text-right padding-right-15">	
						
							<small>Другое {!! Form::checkbox ('change_citezenship', 1, null, ['id'=>'change_citezenship_0'])!!}</small>

						</div>


					</div>



				</div>

				<div class='col-md-6'>

					<div class="form-group col-md-3 no-padding-left padding-right-15">

						{!! Form::selectNonDisabled ('gender[0]', 'Пол', $gender)!!}

					</div>


					<div class='form-group col-md-3'>
						
						{!! Form::text ('phone[0]', null, ['placeholder' => 'Телефон', 'class'=>'form-control'])!!}

					</div>


					<div class='form-group col-md-4'>


							{!! Form::text ('email[0]', null, ['placeholder' => 'Email', 'class'=>'form-control'])!!}

					</div>

				</div>




			</div>


			<div class='row'>


				<div class='form-group col-md-3'>

					{!! Form::label('doc_type[0][0]', 'Документ-1', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

						{!! Form::selectNonDisabled ('doc_type[0][0]', 'Выберите док-т', $choose_doc, null, 'choose-doc')!!}

						</div>

				</div>

				<div class='form-group col-md-3' id='doc_0_div_0'>

					<div class="col-md-4 no-padding inline-block">
						
						{!! Form::text ('doc_seria[0][0]', null, ['placeholder' => 'Серия', 'class'=>'form-control d-block-inline first-doc', 'disabled'])!!}

					</div>

					<div class="col-md-8 no-padding inline-block padding-right-15">

						{!! Form::text ('doc_number[0][0]', null, ['placeholder' => 'Номер', 'class'=>'form-control d-block-inline first-doc', 'disabled'])!!}

					</div>


				</div>

				<div class="col-md-6">

					<div class="col-md-3  no-padding">

					{!! Form::buttonSearch('Найти по паспорту', 'check_doc_0', 'button') !!}

					</div>

					<div class="form-group col-md-3">

							{!! Form::date ('date_issue[0][0]', null, ['placeholder' => 'Дата выдачи', 'class'=>'form-control d-block-inline no-padding-right', 'id' => 'date_issue_1'])!!}
							<small>Дата выдачи</small>

					</div>

					<div class="form-group col-md-3">

							{!! Form::date ('date_expire[0][0]', null, ['placeholder' => 'Дата окончания', 'class'=>'form-control d-block-inline no-padding-right', 'id' => 'date_expire_1'])!!}
							<small>Дата окончания</small>

					</div>

				</div>



			</div>

			<div class='row' id ='row_second_doc_0'>


				<div class='form-group col-md-3'>

					{!! Form::label('doc_type[0][1]', 'Документ-2', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

						{!! Form::selectNonDisabled ('doc_type[0][1]', 'Выберите док-т', $choose_doc, 'disabled', 'choose-doc')!!}

						<div class="row text-right padding-right-15">	
						
							<small>Нужен второй документ {!! Form::checkbox ('add_doc_2', 1, null, ['id'=>'add_doc_2_0'])!!}</small>

						</div>

					</div>


				</div>

				<div class='form-group col-md-3' id='doc_1_div_0'>

					<div class="col-md-4 no-padding inline-block">
						
						{!! Form::text ('doc_seria[0][1]', null, ['placeholder' => 'Серия', 'class'=>'form-control d-block-inline no-padding-right', 'disabled'=>'disabled'])!!}

					</div>

					<div class="col-md-8 no-padding inline-block padding-right-15">

							{!! Form::text ('doc_number[0][1]', null, ['placeholder' => 'Номер', 'class'=>'form-control d-block-inline no-padding-right', 'disabled'=>'disabled'])!!}

					</div>


				</div>

				<div class="col-md-6">

					<div class="col-md-3 no-padding">

				</div>

					<div class="form-group col-md-3">

							{!! Form::date ('date_issue[0][1]', null, ['placeholder' => 'Дата выдачи', 'class'=>'form-control d-block-inline no-padding-right', 'disabled'=>'disabled', 'id' => 'date_issue_2'])!!}
							<small>Дата выдачи</small>

					</div>

					<div class="form-group col-md-3">

							{!! Form::date ('date_expire[0][1]', null, ['placeholder' => 'Дата окончания', 'class'=>'form-control d-block-inline  no-padding-right', 'disabled'=>'disabled', 'id' => 'date_expire_2'])!!}
							<small>Дата окончания</small>

					</div>

				</div>

			</div>


		

			<div class="row" id='payer'>

				<div class='form-group col-md-6'>
					

					{!! Form::label('Заказчик?', null, ['class'=>'col-md-2'])!!}



					<div class="col-md-1 text-left">

						{!! Form::radio ('is_buyer', 0)!!}

					</div>

				</div>


			</div>

			<div class="row" id='delete_tourist'>

				<div class='form-group col-md-6'>
					
					{!! Form::button('Удалить туриста', ['class' => 'inline btn btn-default delete_tourist']) !!}
		
				</div>


			</div>



			</div>

			</div>





			
			<div class='input'>
				
					{!! Form::button('+Еще турист', ['id' => 'add_tourist', 'class' => 'inline btn btn-default']) !!}
			</div>

			
			<div class='input submit'>

				<div class="row submit" >

					<div class="col-md-6" id="divsubmit">

					{!! Form::submit( $verb.=' тур', ['id' => $button, 'class' => 'inline btn btn-success']) !!}

					</div>

				</div>

			</div>

			{!! Form::close()!!}

		</div>

	</div>

</div>

{{-- 

<script type="text/javascript">



function randomselect(name) {

		var length = $('[name="'+name+'"]').find('option').length;
	    var value = Math.floor(Math.random() * (length - 2 + 1)) + 1;
	    value++;
	    $('[name="'+name+'"]').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');

};


function text(j) {
  var text = "";
  var possible = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя0123456789 ";


  for (var i = 0; i < j; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

$('select').each(function () {
	randomselect(this.name);
})

function randomtext(name, j) {
	$('[name*="'+name+'"]').val(text(j));
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


</script>
 --}}

