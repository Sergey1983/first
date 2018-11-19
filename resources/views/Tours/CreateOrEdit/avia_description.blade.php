<div class="container-fluid margin-top-25">

	<div class="row">

		<div class="col-md-12">

			<h4>Описание тура:</h4>

		</div>

	</div>


	<div class="row">
				
		<div class="col-md-12">

			<div class="tour padding-all-10 col-md-12">

			{!!Form::open(['id' => 'tour_form', 'class' =>'form-horizontal'])!!}

				<div class="col-md-6">

			
{!! Form::hidden('tour_type', $tour_type_rus)  !!}
{{-- 						 		{!! Form::hidden('city_from', 'АвиаТур')  !!}
								{!! Form::hidden('city_return_add', 0)!!}
						 		{!! Form::hidden('city_return', 'АвиаТур')!!}
						 		{!! Form::hidden('airport', 'AVIA')  !!} --}}
								{!! Form::hidden('operator', '44') !!}
								{!! Form::hidden('nights', 0) !!}
{{-- 								{!! Form::hidden('date_depart', '1900-11-21') !!}
 --}}								{!! Form::hidden('date_hotel', 0) !!}
								{!! Form::hidden('hotel', 'АвиаТур') !!}
								{!! Form::hidden('room', 'АвиаТур') !!}
								{!! Form::hidden('add_rooms', 0) !!}
								{!! Form::hidden('food_type', 'АвиаТур') !!}
								{!! Form::hidden('change_food_type', 0) !!}
								{!! Form::hidden('currency', 'RUB') !!}
								{!! Form::hidden('change_food_type', 0) !!}
								{!! Form::hidden('transfer', 'АвиаТур') !!}
								{!! Form::hidden('noexit_insurance', 'АвиаТур') !!}
								{!! Form::hidden('noexit_insurance_add_people', 0) !!}
								{!! Form::hidden('noexit_insurance_people') !!}
								{!! Form::hidden('med_insurance', 0) !!}
								{!! Form::hidden('visa', 'АвиаТур') !!}
								{!! Form::hidden('visa_add_people', 0) !!}
								{!! Form::hidden('change_food_type', 0) !!}
								{!! Form::hidden('visa_people') !!}
								{!! Form::hidden('sightseeing') !!}
								{!! Form::hidden('change_sightseeing', 0) !!}












						<div class="form-group" id="city_from_form_group">

							{!! Form::label('city_from', 'Город вылета', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('city_from', $cities, null, ['placeholder' =>  'Выберите город', 'class'=>"form-control", 'id'=>'city_from'] )  !!}
								
								<div class="row">


									<div class="col-md-12 text-right">	

@php 

	$checked = ( (isset($tour)) && ($tour->city_return_add == 1)) ? true : false

@endphp
									
									<small>Город возвращения отличается {!! Form::checkbox ('city_return_add', 1, $checked, ['id'=>'city_return_add'])!!}</small>

									</div>

								</div>

						 	</div>
							
						</div>

@if($checked)


							<div class="form-group" id="city_return_form_group">

								{!! Form::label('city_return', 'Город возвращения', ['class'=>'control-label col-md-4'])!!}

								<div class="col-md-8">

						 			{!! Form::select('city_return', $cities, null, ['placeholder' =>  'Выберите город', 'class'=>"form-control", 'id'=>'city_return'] )  !!}

								</div>

							</div>

@endif





						<div class="form-group">

							{!! Form::label('country', 'Cтрана назначения', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('country', $countries, null, ['placeholder' =>  'Выберите страну', 'class'=>"form-control", 'id'=>'country'] )  !!}

						 	</div>
							
						</div>

					 	<div class="form-group">
							
							{!! Form::label('airport', 'Аэропорт назначения', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		@php 

						 		$airport = new App\Airport;

						 		$airports = isset($tour) ? $airport->airports_array($tour->country) : [0=>'Сначала выберите страну'] 

						 		@endphp

							

						 		{!! Form::select('airport', $airports, null, ['class'=>"form-control", 'id'=>'airport'] )  !!}

						 	</div>

						</div>

{{-- 					 	<div class="form-group">
							
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

						</div> --}}

					 	<div class="form-group">
							
								{!! Form::label('date_depart', 'Вылет', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">



								{!! Form::date ('date_depart', null, ['class'=>'form-control', 'id'=>'date_depart'])!!}

{{-- 								<div class="row ">


									<div class="col-md-12 text-right">	

@php 

	$checked = ( (isset($tour)) && ($tour->date_hotel == 1)) ? true : false

@endphp
									
									<small>Заселение в отель на день позже {!! Form::checkbox ('date_hotel', 1, $checked, ['id'=>'date_hotel'])!!}</small>

									</div>

								</div> --}}


						 	</div>

						</div>

{{-- 					 	<div class="form-group">


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

						</div> --}}

					 	<div class="form-group" id="price_rub">


							{!! Form::label('price_rub', 'Стоимость в рублях', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::text('price_rub', null, ['placeholder' =>  'Округляйте сумму', 'class'=>"form-control", 'id'=>'price_rub'] )  !!}

						 	</div>

						</div>

@php 

	$checked = ( (isset($tour)) && ($tour->is_credit == 1)) ? true : false

@endphp

					 	<div class="form-group" id="is_credit">

							{!! Form::label('is_credit', 'Тур преобретается в кредит', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">


 								{!! Form::select('is_credit', [0 => 'нет', 1 => 'да'], $checked, ['placeholder' =>  'Не выбрано', 'class'=>"form-control", 'id'=>'is_credit'])!!}

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
					
{{-- 
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

 --}}

						<div class="form-group">

							{!! Form::label('extra_info', 'Маршрут:', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">


						 		{!! Form::textarea('extra_info', null, ['placeholder' =>  'Введите маршрут', 'class'=>"form-control", 'id'=>'extra_info', 'required'] )  !!}


						 	</div>

						</div>



					 	<div class="form-group">
							
								{!! Form::label('operator_full_pay', 'Срок полной оплаты оператору', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">


								{!! Form::date ('operator_full_pay', null, ['class'=>'form-control', 'id'=>'operator_full_pay'])!!}


						 	</div>

						</div>



@if(Auth::user()->isAdmin()) 


					 	<div class="form-group">
							
							{!! Form::label('branch_id', 'Филиал', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::select('branch_id', $branches, 

						 			null

						 		, ['placeholder' =>  'Выберите', 'class'=>"form-control", 'id'=>'currency'] )  !!}

						 	</div>

						</div>
@endif

				</div>

				{!!Form::close()!!}

				</div>

		</div>

	</div>


</div>
