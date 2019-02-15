@php 
      setlocale(LC_TIME, 'ru_RU', 'ru_RU.utf8');
      use App\Services\RusMonth;


@endphp

<div class="container-fluid margin-top-25">
	
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
						<td>{{date('d-m-Y H-i-s', strtotime($tour->created_at))}}</td>
					</tr>

					<tr>
						<td>Менеджер создавший</td>
						<td>{{$tour->user_created()}}</td>
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
						<td>Статус заявки</td>
						<td>{{is_null($tour->status)? 'Еще нет статуса': $tour->status}}</td>
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
						<td>{{ is_null($tour->operator_full_pay) ? 'Заявка ещё не подтверждена' : RusMonth::convert(strftime('%d %B %Y', strtotime($tour->operator_full_pay))) }}</td>
					</tr>
					
					<tr>
						<td>Срок частичной оплаты опер-ру</td>
						<td>{{ is_null($tour->operator_part_pay) ? 'Заявка ещё не подтверждена' : RusMonth::convert(strftime('%d %B %Y', strtotime($tour->operator_part_pay))) }}</td>
					</tr>

					<tr>
						<td>Статус оплаты оператору</td>
						@php $debt_operator = $tour->operator_price_rub - $tour->payments_to_operator_rub_sum(); 

						switch($debt_operator) {

							case 0: $debt_operator = 'Оплачено'; break;
							case $tour->operator_price_rub: $debt_operator = 'Не оплачено'; break;
							default: $debt_operator = 'Частично';
						}
						
						@endphp

						<td>{{!is_null($tour->operator_price_rub) ? $debt_operator : 'Заявка ещё не подтверждена' }}
</td>
					</tr>

					<tr>
						<td>Оплата в кредит?</td>
						<td>{{($tour->first_payment===null) ? 'Нет': 'Да'}}</td>
					</tr>


@unless($tour->first_payment===null)

					<tr>
						<td>Первый взнос за кредит</td>
						<td>{{$tour->first_payment}}</td>
					</tr>

					<tr>
						<td>Банк-кредитор</td>
						<td>{{$tour->bank}}</td>
					</tr>


@endunless

	@if(Auth::user()->isAdmin())

					<tr>
						<td>Филиал</td>
						<td>{{$tour->branch->name}}</td>
					</tr>


	@endif



			</table>

		</div>



		<div class="col-md-6">
			
			<table class="table table-responsive table-bordered table-striped col-md-12">
				
				<tr>
					<th colspan="2">Описание тура</th>
				</tr>

				<tr>
					<td class="col-md-4">Продукт</td>
					<td><strong>{{$tour->tour_type}}</strong></td>
				</tr>

{{-- 				<tr>
					<td>Город отправления</td>
					<td>{{$tour->city_from}}</td>
				</tr>

@unless(is_null($tour->city_return))
				<tr>
					<td>Город возвращения</td>
					<td>{{$tour->city_return}}</td>
				</tr>
@endunless
 --}}
				<tr>
					<td>Cтрана пребывания</td>
					<td>{{$tour->country}}
					</td>
				</tr>
{{-- 
				<tr>
					<td>Аэропорт прибытия</td>

					@php 

					$airport = $tour->airport != '-' ? $tour->airport_model->code.', '.$tour->airport_model->name.', '.$tour->airport_model->country : '-'

					@endphp
			
 					<td>{{$airport}}</td>	
 				</tr> --}}

{{-- 				<tr>
					<td>Пребывание с</td> --}}
						@php
						$date_depart = strtotime($tour->date_depart);
						@endphp
{{-- 					<td>{{strftime('%d %B %Y', $date_depart)}}</td>
				</tr> --}}


				<tr>
					<td>Пребывание в отеле</td>
						@php
						$date_hotel = $tour->date_hotel == 0 ? $date_depart : strtotime("+1 days", $date_depart);
						@endphp

					<td>{{ RusMonth::convert(strftime('%d %B %Y', $date_hotel)) }}</td>
				</tr>

				<tr>
					<td>Ночей в отеле</td>
					<td>{{$nights = $tour->nights}}</td>
				</tr>

				<tr>
					<td>Обратный вылет</td>
					@php
						$date_return = strtotime('+'.$nights.' days', $date_hotel);
					@endphp
					<td>{{RusMonth::convert(strftime('%d %B %Y', $date_return))}}</td>
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
					<td>{!!nl2br($tour->room)!!}</td>
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