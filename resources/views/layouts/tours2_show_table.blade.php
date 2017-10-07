

<div class="container-fluid">
	
	<div class="row">
		
		<div class="col-md-6">
			
			<table class="table table-responsive table-bordered table-striped col-md-12">
				

				<tr>

					<th colspan='2'>Параметры заявки</th>

				</tr>


					<tr>
						<td class="col-md-6">Номер заявки</td>
						<td>{{$tour->id}}</td>
					</tr>

					<tr>
						<td>Время подачи заявки</td>
						<td>{{$tour->created_at}}</td>
					</tr>

					<tr>
						<td>Менеджер создавший</td>
						<td>{{
						$tour->previous_tours->isNotEmpty() ? 
						$tour->previous_tours->sortby('created_at')->first()->user->name :
						$tour->user->name  
						}}
						</td>
					</tr>

					<tr>
						<td>Источник заявки</td>
						<td>{{$tour->source}}</td>
					</tr>

					<tr>
						<td>Туроператор</td>
						<td>{{$tour->operator}}</td>
					</tr>

					<tr>
						<td>Номер заявки у поставщика</td>
						<?php $booked_not = 'Заявка ещё не подтверждена'?>
						<td>{{is_null($tour->operator_code)? $booked_not: $tour->operator_code}}</td>
					</tr>

					<tr>
						<td>Валюта тура</td>
						<td>{{strtoupper($tour->currency)}}</td>
					</tr>

					<tr>
						<td>Стоимость для туриста ({{strtoupper($tour->currency)}}@unless(!isset($tour->price)){{' / RUB'}}@endunless)</td>
						<td>{{isset($tour->price)? $tour->price : $tour->price_rub}}@unless(!isset($tour->price)) / {{$tour->price_rub}}@endunless </td>
					</tr>

					<tr>
						<td>Долг туриста ({{strtoupper($tour->currency)}})</td>
						<td>{{$tour->price - $tour->payments_from_tourists_sum()}}</td>
					</tr>



					<tr>
						<td>К оплате оператору (RUB)</td>
						<td>{{is_null($tour->operator_price_rub)? 'Заявка ещё не подтверждена': $tour->operator_price_rub}}</td>
					</tr>

@if (($tour->payments_from_tourists_rub_sum() != 0) AND ($tour->payments_from_tourists_sum() === $tour->price) AND ($tour->payments_to_operator_rub_sum() === $tour->operator_price_rub)) 

					<tr>
						<td>Комиссия (RUB)</td>
						<td>{{ round ( ( 1 - $tour->payments_to_operator_rub_sum() / $tour->payments_from_tourists_rub_sum() ) * 100, 2)}}%</td>
					</tr>

@endif

					<tr>
						<td>Срок полной оплаты опер-ру</td>
						<td>{{is_null($tour->operator_full_pay)? 'Заявка ещё не подтверждена': date_format(date_create_from_format('Y-m-d', $tour->operator_full_pay), 'd-m-Y')}}</td>
					</tr>
					
					<tr>
						<td>Срок частичной оплаты опер-ру</td>
						<td>{{is_null($tour->operator_part_pay)? 'Заявка ещё не подтверждена': date_format(date_create_from_format('Y-m-d', $tour->operator_part_pay), 'd-m-Y')}}</td>
					</tr>

					<tr>
						<td>Статус оплаты оператору</td>
						<?php $debt_operator = $tour->operator_price_rub - $tour->payments_to_operator_rub_sum(); ?>
						<?php $debt_operator = $debt_operator == 0 ? 'Оплачено' : 'Не оплачено' ?>
						<td>{{!is_null($tour->operator_price_rub) ? $debt_operator : 'Заявка ещё не подтверждена' }}
</td>
					</tr>

					<tr>
						<td>Оплата в кредит?</td>
						<td>{{($tour->first_payment==null) ? 'Нет': 'Да'}}</td>
					</tr>


@unless($tour->first_payment==null)

					<tr>
						<td>Первый взнос за кредит</td>
						<td>{{$tour->first_payment}}</td>
					</tr>

					<tr>
						<td>Банк-кредитор</td>
						<td>{{$tour->bank}}</td>
					</tr>


@endunless





			</table>

		</div>



		<div class="col-md-6">
			
			<table class="table table-responsive table-bordered table-striped col-md-12">
				
				<tr>
					<th colspan="2">Описание тура</th>
				</tr>

				<tr>
					<td class="col-md-4">Продукт</td>
					<td>Отельный тур</td>
				</tr>

				<tr>
					<td>Город отправления</td>
					<td>{{$tour->city_from}}</td>
				</tr>

				<tr>
					<td>Cтрана пребывания</td>
					<td>{{$tour->country}}
					</td>
				</tr>

				<tr>
					<td>Аэропорт прибытия</td>

					@php 

					$airport = $tour->airport != '-' ? $tour->airport_model->code.', '.$tour->airport_model->name.', '.$tour->airport_model->country : '-'

					@endphp
			
 					<td>{{$airport}}</td>	
 				</tr>

				<tr>
					<td>Пребывание с</td>
					@php $date=date_create_from_format('Y-m-d', $tour->date_depart)
					@endphp
					<td>{{date_format($date, 'd-m-Y')}}</td>
				</tr>

				<tr>
					<td>Пребывание в отеле</td>
					<td>{{ $date = $tour->date_hotel ? date('d-m-Y', strtotime($tour->date_depart. ' + 1 days')) : date_format($date, 'd-m-Y') }}</td>
				</tr>


				<tr>
					<td>Ночей</td>
					<td>{{$tour->nights}}</td>
				</tr>

				<tr>
					<td>Отель </td>
					<td>{{$tour->hotel}}</td>
				</tr>

				<tr>
					<td>Количество туристов</td>
					<td>{{$tour->tourists->count()}}</td>
				</tr>

				<tr>
					<td>Номера</td>
					<td>{{$tour->room}}</td>
				</tr>

				<tr>
					<td>Питание</td>
					<td>{{$tour->food_type}}</td>
				</tr>

				<tr>
					<td>Трансфер</td>
					<td>{{$tour->transfer}}</td>
				</tr>

				<tr>
					<td>Страховка от невыезда</td>
					<td>{{$tour->noexit_insurance}}</td>
				</tr>

@unless($tour->noexit_insurance_people == null)
				<tr>
					<td>Кому оформляется стр-ка от невыезда</td>
					<td>{{$tour->noexit_insurance_people}}</td>
				</tr>
@endunless

				<tr>
					<td>Мед. страховка</td>
					<td>{{$tour->med_insurance}}</td>
				</tr>

				<tr>
					<td>Оформление визы</td>
					<td>{{$tour->visa}}</td>
				</tr>

@unless($tour->visa_people == null)
				<tr>
					<td>Кому оформляется виза</td>
					<td>{{$tour->visa_people}}</td>
				</tr>
@endunless

				<tr>
					<td>Экскурсия</td>
					<td>{{$tour->sightseeing}}</td>
				</tr>

				<tr>
					<td>Дополнительная информация</td>
					<td style="word-break: break-word">{{$tour->extra_info}}</td>
				</tr>


			</table>

		</div>

	</div>


</div>


<div class="container-fluid margin-bottom-10">

	@include('buttons.book_tour')
    @include('buttons.pay_tourist')	

@unless(is_null($tour->operator_price_rub))	
	@include('buttons.pay_operator')
@endunless

</div>



<div class="container-fluid">


	@foreach ($tour_tourists_docs as $key => $tour_tourists_doc)


	<h4> Турист {{$key+1}}: </h4>


	<div class="row">

		<div class="col-md-12">
		
			<table class="table table-responsive table-bordered table-striped">

				<tr>

				    <th>Id</th>
				    <th>Имя</th>
				    <th>Фамилия</th>
				    <th>Имя Англ.</th>
				    <th>Фамилия Англ.</th>    
				    <th>День рож-я</th>
				    <th>Гражданство</th>
				    <th>Пол</th>
				    <th>Телефон</th>
				    <th>Email</th>

				</tr>

				<tr>

@php

	$tourist = $tour_tourists_doc->tourist;

@endphp


				    <td>{{$tourist->id}}</td>
				    <td>{{$tourist->name}}</td>
				    <td>{{$tourist->lastName}}</td>
				    <td>{{$tourist->nameEng}}</td>
				    <td>{{$tourist->lastNameEng}}</td>    
				    <td>{{$tourist->birth_date}}</td>
				    <td>{{$tourist->citizenship}}</td>
				    <td>{{$tourist->gender}}</td>
				    <td>{{$tourist->phone}}</td>
				    <td>{{$tourist->email}}</td>


				</tr>

			</table>

			</div>

			<div class="col-md-6">

					<table class="table table-responsive table-bordered table-striped">

						<tr>

						    <th class="col-md-4">Тип док-а 1</th>
						    <th class="col-md-4">Номер док-а</th>
						    <th class="col-md-2">Дата выдачи</th>
						    <th class="col-md-2">Дата окон-я</th>

						</tr>

						<tr>
@php

	$document = $tour_tourists_doc->document0;

@endphp
						    <td>{{$document->doc_type}}</td>
						    <td>{{$document->doc_number}}</td>
						    <td>{{$document->date_issue}}</td>
						    <td>{{$document->date_expire}}</td>
						
						</tr>


					</table>

			</div>
			


@if($document = $tour_tourists_doc->document1)


			<div class="col-md-6">

					<table class="table table-responsive table-bordered table-striped">

						<tr>

						    <th class="col-md-4">Тип док-а 2</th>
						    <th class="col-md-4">Номер док-а</th>
						    <th class="col-md-2">Дата выдачи</th>
						    <th class="col-md-2">Дата окон-я</th>

						</tr>

						<tr>

						    <td>{{$document->doc_type}}</td>
						    <td>{{$document->doc_number}}</td>
						    <td>{{$document->date_issue}}</td>
						    <td>{{$document->date_expire}}</td>
						
						</tr>


					</table>

			</div>
@endif


	</div>


@endforeach






