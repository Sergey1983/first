console.log('get_tour_info_for_versions.js loaded');

	function get_tour_info_for_versions(j, data, tour, tourists, date_hotel) {
		
	
		var tour_type = tour.tour_type;


		switch(tour_type) {

			case 'Пакетный':

			to_return = packet_tour(j, data, tour, tourists, date_hotel);

			break;


			case 'Отельный':

			to_return = hotel(j, data, tour, tourists, date_hotel);


			break;

			case 'Авиа':

			to_return = avia(j, data, tour, tourists, date_hotel);

			break;
		}



		return to_return;

	}



	function packet_tour (j, data, tour, tourists, date_hotel) {

	return html = '<div class="container-fluid margin-top-25">'+

	'<div class="row">'+

		'<div class="col-md-12 text-center">'+

			'Создана: '+data[j].version_created+' пользователем: '+data[j].user+

		'</div>'+

	'</div>'+

'</div>'+

'<div class="container-fluid margin-top-25">'+
	
	'<div class="row">'+
		
		'<div class="col-md-6">'+
			
			'<table class="table table-responsive table-bordered table-striped col-md-12">'+


			'<tr>'+

					'<th colspan="2">Параметры заявки</th>'+

				'</tr>'+


					'<tr>'+
						'<td class="col-md-6">Номер заявки</td>'+
						'<td id="tour_id_'+j+'">'+tour.tour_id+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Время подачи заявки</td>'+
						'<td>'+tour.created_at+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Менеджер создавший</td>'+
						'<td id="user_name_'+j+'">'+tour.user_name+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Источник заявки</td>'+
						'<td id="source_'+j+'">'+tour.source+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Туроператор</td>'+
						'<td id="operator_'+j+'">'+tour.operator+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Номер заявки у поставщика</td>'+
						'<td id="operator_code_'+j+'">'+(tour.operator_code == null ? 'Заявка еще не подтверждена' : tour.operator_code)+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Валюта тура</td>'+
						'<td id="currency_'+j+'">'+tour.currency+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Стоимость для туриста ('+(tour.price != null ? tour.currency+' / RUB' : 'RUB')+')</td>'+
						'<td id="price_rub_'+j+'">'+ (tour.price != null ? tour.price+' / '+tour.price_rub : tour.price_rub) +' </td>'+
					'</tr>'+



					'<tr>'+
						'<td>Долг туриста</td>'+
						'<td>-</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Статус</td>'+
						'<td id="status_'+j+'">' + (tour.status == null ? 'Еще нет' : tour.status) + '</td>'+
					'</tr>'+


					'<tr>'+
						'<td>К оплате оператору (RUB)</td>'+
						'<td id="operator_price_rub_'+j+'">' + (tour.operator_price_rub == null ? 'Заявка еще не подтверждена' : tour.operator_price_rub) + '</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Комиссия (RUB)</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Срок полной оплаты опер-ру</td>'+
						'<td id="operator_full_pay_'+j+'">'+(tour.operator_full_pay == null ? 'Заявка ещё не подтверждена' : tour.operator_full_pay)+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Срок частичной оплаты опер-ру</td>'+
						'<td id="operator_part_pay_'+j+'">'+(tour.operator_part_pay == null ? 'Заявка ещё не подтверждена': tour.operator_part_pay)+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Статус оплаты оператору</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Филиал</td>'+
						'<td id="branch_name_'+j+'">'+tour.branch_name+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Оплата в кредит?</td>'+
						'<td>'+(tour.first_payment==null ? 'Нет': 'Да')+'</td>'+
					'</tr>'+


					(tour.first_payment!=null ?


					'<tr>'+
						'<td>Первый взнос за кредит</td>'+
						'<td id="first_payment_'+j+'">'+tour.first_payment+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Банк-кредитор</td>'+
						'<td id="bank_'+j+'">'+tour.bank+'</td>'+
					'</tr>' 

					: '')+

					'</table>'+

				'</div>'+


				'<div class="col-md-6">'+
					
					'<table class="table table-responsive table-bordered table-striped col-md-12">'+
						
						'<tr>'+
							'<th colspan="2">Описание тура</th>'+
						'</tr>'+

						'<tr>'+
							'<td class="col-md-4">Продукт</td>'+
							'<td>Отельный тур</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Город отправления</td>'+
							'<td id = "city_from_'+j+'">'+tour.city_from+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Город возвращения</td>'+
							'<td id = "city_return_'+j+'">'+tour.city_return+'</td>'+
						'</tr>'+


						'<tr>'+
							'<td>Cтрана пребывания</td>'+
							'<td id = "country_'+j+'">'+tour.country+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Аэропорт прибытия</td>'+					
		 					'<td id = "airport_'+j+'">'+tour.airport+'</td>'+	
		 				'</tr>'+

						'<tr>'+
							'<td>Пребывание с </td>'+
							'<td id = "date_depart_'+j+'">'+tour.date_depart+'</td>'+
						'</tr>'+


						'<tr>'+
							'<td>Пребывание в отеле</td>'+
							'<td id="date_depart_'+j+'">'+(tour.date_hotel == null ? tour.date_depart : date_hotel)+'</td>'+
						'</tr>'+


						'<tr>'+
							'<td>Ночей в отеле</td>'+
							'<td id="nights_'+j+'">'+tour.nights+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Отель </td>'+
							'<td id="hotel_'+j+'">'+tour.hotel+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Количество туристов</td>'+
							'<td id="number_of_tourists_'+j+'">'+tourists.length+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Номера</td>'+
							'<td id="room_'+j+'">'+tour.room+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Питание</td>'+
							'<td id="food_type_'+j+'">'+tour.food_type+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Трансфер</td>'+
							'<td id="transfer_'+j+'">'+tour.transfer+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Страховка от невыезда</td>'+
							'<td id="noexit_insurance_'+j+'">'+tour.noexit_insurance+'</td>'+
						'</tr>'+


						(tour.noexit_insurance_people != null ? 

							'<tr>'+
								'<td>Кому оформляется стр-ка от невыезда</td>'+
								'<td id="noexit_insurance_people_'+j+'">'+tour.noexit_insurance_people+'</td>'+
							'</tr>'

							: '')+

						'<tr>'+
							'<td>Мед. страховка</td>'+
							'<td id="med_insurance_'+j+'">'+(tour.med_insurance == 1 ? 'Да' : 'Нет')+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Оформление визы</td>'+
							'<td id="visa_'+j+'">'+tour.visa+'</td>'+
						'</tr>'+

						(tour.visa_people != null ?
						
						'<tr>'+
							'<td>Кому оформляется виза</td>'+
							'<td id="visa_people_'+j+'">'+tour.visa_people+'</td>'+
						'</tr>' 

						: '')+

						'<tr>'+
							'<td>Экскурсия</td>'+
							'<td id="sightseeing_'+j+'">'+tour.sightseeing+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Дополнительная информация</td>'+
							'<td id="extra_info_'+j+'" style="word-break: break-word">'+tour.extra_info+'</td>'+
						'</tr>'+


					'</table>'+

				'</div>'+

			'</div>'+

		'</div>';


	}













	function hotel (j, data, tour, tourists, date_hotel) {

	return html = '<div class="container-fluid margin-top-25">'+

	'<div class="row">'+

		'<div class="col-md-12 text-center">'+

			'Создана: '+data[j].version_created+' пользователем: '+data[j].user+

		'</div>'+

	'</div>'+

'</div>'+

'<div class="container-fluid margin-top-25">'+
	
	'<div class="row">'+
		
		'<div class="col-md-6">'+
			
			'<table class="table table-responsive table-bordered table-striped col-md-12">'+


			'<tr>'+

					'<th colspan="2">Параметры заявки</th>'+

				'</tr>'+


					'<tr>'+
						'<td class="col-md-6">Номер заявки</td>'+
						'<td id="tour_id_'+j+'">'+tour.tour_id+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Время подачи заявки</td>'+
						'<td>'+tour.created_at+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Менеджер создавший</td>'+
						'<td id="user_name_'+j+'">'+tour.user_name+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Источник заявки</td>'+
						'<td id="source_'+j+'">'+tour.source+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Туроператор</td>'+
						'<td id="operator_'+j+'">'+tour.operator+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Номер заявки у поставщика</td>'+
						'<td id="operator_code_'+j+'">'+(tour.operator_code == null ? 'Заявка еще не подтверждена' : tour.operator_code)+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Валюта тура</td>'+
						'<td id="currency_'+j+'">'+tour.currency+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Стоимость для туриста ('+(tour.price != null ? tour.currency+' / RUB' : 'RUB')+')</td>'+
						'<td id="price_rub_'+j+'">'+ (tour.price != null ? tour.price+' / '+tour.price_rub : tour.price_rub) +' </td>'+
					'</tr>'+



					'<tr>'+
						'<td>Долг туриста</td>'+
						'<td>-</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Статус</td>'+
						'<td id="status_'+j+'">' + (tour.status == null ? 'Еще нет' : tour.status) + '</td>'+
					'</tr>'+

					'<tr>'+
						'<td>К оплате оператору (RUB)</td>'+
						'<td id="operator_price_rub_'+j+'">' + (tour.operator_price_rub == null ? 'Заявка еще не подтверждена' : tour.operator_price_rub) + '</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Комиссия (RUB)</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Срок полной оплаты опер-ру</td>'+
						'<td id="operator_full_pay_'+j+'">'+(tour.operator_full_pay == null ? 'Заявка ещё не подтверждена' : tour.operator_full_pay)+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Срок частичной оплаты опер-ру</td>'+
						'<td id="operator_part_pay_'+j+'">'+(tour.operator_part_pay == null ? 'Заявка ещё не подтверждена': tour.operator_part_pay)+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Статус оплаты оператору</td>'+
						'<td>-</td>'+
					'</tr>'+
					
					'<tr>'+
						'<td>Филиал</td>'+
						'<td id="branch_name_'+j+'">'+tour.branch_name+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Оплата в кредит?</td>'+
						'<td>'+(tour.first_payment==null ? 'Нет': 'Да')+'</td>'+
					'</tr>'+

					(tour.first_payment!=null ?


					'<tr>'+
						'<td>Первый взнос за кредит</td>'+
						'<td id="first_payment_'+j+'">'+tour.first_payment+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Банк-кредитор</td>'+
						'<td id="bank_'+j+'">'+tour.bank+'</td>'+
					'</tr>' 

					: '')+

					'</table>'+

				'</div>'+


				'<div class="col-md-6">'+
					
					'<table class="table table-responsive table-bordered table-striped col-md-12">'+
						
						'<tr>'+
							'<th colspan="2">Описание тура</th>'+
						'</tr>'+

						'<tr>'+
							'<td class="col-md-4">Продукт</td>'+
							'<td>'+tour.tour_type+'</td>'+
						'</tr>'+

						// '<tr>'+
						// 	'<td>Город отправления</td>'+
						// 	'<td id = "city_from_'+j+'">'+tour.city_from+'</td>'+
						// '</tr>'+

						'<tr>'+
							'<td>Cтрана пребывания</td>'+
							'<td id = "country_'+j+'">'+tour.country+'</td>'+
						'</tr>'+

						// '<tr>'+
						// 	'<td>Аэропорт прибытия</td>'+					
		 			// 		'<td id = "airport_'+j+'">'+tour.airport+'</td>'+	
		 			// 	'</tr>'+

						'<tr>'+
							'<td>Пребывание с </td>'+
							'<td id = "date_depart_'+j+'">'+tour.date_depart+'</td>'+
						'</tr>'+


						// '<tr>'+
						// 	'<td>Пребывание в отеле</td>'+
						// 	'<td id="date_depart_'+j+'">'+(tour.date_hotel == null ? tour.date_depart : date_hotel)+'</td>'+
						// '</tr>'+


						'<tr>'+
							'<td>Ночей в отеле</td>'+
							'<td id="nights_'+j+'">'+tour.nights+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Отель </td>'+
							'<td id="hotel_'+j+'">'+tour.hotel+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Количество туристов</td>'+
							'<td id="number_of_tourists_'+j+'">'+tourists.length+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Номера</td>'+
							'<td id="room_'+j+'">'+tour.room+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Питание</td>'+
							'<td id="food_type_'+j+'">'+tour.food_type+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Трансфер</td>'+
							'<td id="transfer_'+j+'">'+tour.transfer+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Страховка от невыезда</td>'+
							'<td id="noexit_insurance_'+j+'">'+tour.noexit_insurance+'</td>'+
						'</tr>'+


						(tour.noexit_insurance_people != null ? 

							'<tr>'+
								'<td>Кому оформляется стр-ка от невыезда</td>'+
								'<td id="noexit_insurance_people_'+j+'">'+tour.noexit_insurance_people+'</td>'+
							'</tr>'

							: '')+

						'<tr>'+
							'<td>Мед. страховка</td>'+
							'<td id="med_insurance_'+j+'">'+(tour.med_insurance == 1 ? 'Да' : 'Нет')+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Оформление визы</td>'+
							'<td id="visa_'+j+'">'+tour.visa+'</td>'+
						'</tr>'+

						(tour.visa_people != null ?
						
						'<tr>'+
							'<td>Кому оформляется виза</td>'+
							'<td id="visa_people_'+j+'">'+tour.visa_people+'</td>'+
						'</tr>' 

						: '')+

						'<tr>'+
							'<td>Экскурсия</td>'+
							'<td id="sightseeing_'+j+'">'+tour.sightseeing+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Дополнительная информация</td>'+
							'<td id="extra_info_'+j+'" style="word-break: break-word">'+tour.extra_info+'</td>'+
						'</tr>'+


					'</table>'+

				'</div>'+

			'</div>'+

		'</div>';


	}
















	function avia (j, data, tour, tourists, date_hotel) {

	return html = '<div class="container-fluid margin-top-25">'+

	'<div class="row">'+

		'<div class="col-md-12 text-center">'+

			'Создана: '+data[j].version_created+' пользователем: '+data[j].user+

		'</div>'+

	'</div>'+

'</div>'+

'<div class="container-fluid margin-top-25">'+
	
	'<div class="row">'+
		
		'<div class="col-md-6">'+
			
			'<table class="table table-responsive table-bordered table-striped col-md-12">'+


			'<tr>'+

					'<th colspan="2">Параметры заявки</th>'+

				'</tr>'+


					'<tr>'+
						'<td class="col-md-6">Номер заявки</td>'+
						'<td id="tour_id_'+j+'">'+tour.tour_id+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Время подачи заявки</td>'+
						'<td>'+tour.created_at+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Менеджер создавший</td>'+
						'<td id="user_name_'+j+'">'+tour.user_name+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Источник заявки</td>'+
						'<td id="source_'+j+'">'+tour.source+'</td>'+
					'</tr>'+

					// '<tr>'+
					// 	'<td>Туроператор</td>'+
					// 	'<td id="operator_'+j+'">'+tour.operator+'</td>'+
					// '</tr>'+


					// '<tr>'+
					// 	'<td>Номер заявки у поставщика</td>'+
					// 	'<td id="operator_code_'+j+'">'+(tour.operator_code == null ? 'Заявка еще не подтверждена' : tour.operator_code)+'</td>'+
					// '</tr>'+


					// '<tr>'+
					// 	'<td>Валюта тура</td>'+
					// 	'<td id="currency_'+j+'">'+tour.currency+'</td>'+
					// '</tr>'+


					'<tr>'+
						'<td>Стоимость для туриста ('+(tour.price != null ? tour.currency+' / RUB' : 'RUB')+')</td>'+
						'<td id="price_rub_'+j+'">'+ (tour.price != null ? tour.price+' / '+tour.price_rub : tour.price_rub) +' </td>'+
					'</tr>'+



					'<tr>'+
						'<td>Долг туриста</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Статус</td>'+
						'<td id="status_'+j+'">' + (tour.status == null ? 'Еще нет' : tour.status) + '</td>'+
					'</tr>'+

					'<tr>'+
						'<td>К оплате оператору (RUB)</td>'+
						'<td id="operator_price_rub_'+j+'">' + (tour.operator_price_rub == null ? 'Заявка еще не подтверждена' : tour.operator_price_rub) + '</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Комиссия (RUB)</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Срок полной оплаты опер-ру</td>'+
						'<td id="operator_full_pay_'+j+'">'+(tour.operator_full_pay == null ? 'Заявка ещё не подтверждена' : tour.operator_full_pay)+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Срок частичной оплаты опер-ру</td>'+
						'<td id="operator_part_pay_'+j+'">'+(tour.operator_part_pay == null ? 'Заявка ещё не подтверждена': tour.operator_part_pay)+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Статус оплаты оператору</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Филиал</td>'+
						'<td id="branch_name_'+j+'">'+tour.branch_name+'</td>'+
					'</tr>'+
					
					'<tr>'+
						'<td>Оплата в кредит?</td>'+
						'<td>'+(tour.first_payment==null ? 'Нет': 'Да')+'</td>'+
					'</tr>'+

					(tour.first_payment!=null ?


					'<tr>'+
						'<td>Первый взнос за кредит</td>'+
						'<td id="first_payment_'+j+'">'+tour.first_payment+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Банк-кредитор</td>'+
						'<td id="bank_'+j+'">'+tour.bank+'</td>'+
					'</tr>' 

					: '')+

					'</table>'+

				'</div>'+


				'<div class="col-md-6">'+
					
					'<table class="table table-responsive table-bordered table-striped col-md-12">'+
						
						'<tr>'+
							'<th colspan="2">Описание тура</th>'+
						'</tr>'+

						'<tr>'+
							'<td class="col-md-4">Продукт</td>'+
							'<td>'+tour.tour_type+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Город отправления</td>'+
							'<td id = "city_from_'+j+'">'+tour.city_from+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Город возвращения</td>'+
							'<td id = "city_return_'+j+'">'+tour.city_return+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Cтрана пребывания</td>'+
							'<td id = "country_'+j+'">'+tour.country+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Аэропорт прибытия</td>'+					
		 					'<td id = "airport_'+j+'">'+tour.airport+'</td>'+	
		 				'</tr>'+

						// '<tr>'+
						// 	'<td>Пребывание с </td>'+
						// 	'<td id = "date_depart_'+j+'">'+tour.date_depart+'</td>'+
						// '</tr>'+


						// '<tr>'+
						// 	'<td>Пребывание в отеле</td>'+
						// 	'<td id="date_depart_'+j+'">'+(tour.date_hotel == null ? tour.date_depart : date_hotel)+'</td>'+
						// '</tr>'+


						// '<tr>'+
						// 	'<td>Ночей в отеле</td>'+
						// 	'<td id="nights_'+j+'">'+tour.nights+'</td>'+
						// '</tr>'+

						// '<tr>'+
						// 	'<td>Отель </td>'+
						// 	'<td id="hotel_'+j+'">'+tour.hotel+'</td>'+
						// '</tr>'+

						'<tr>'+
							'<td>Количество туристов</td>'+
							'<td id="number_of_tourists_'+j+'">'+tourists.length+'</td>'+
						'</tr>'+

						// '<tr>'+
						// 	'<td>Номера</td>'+
						// 	'<td id="room_'+j+'">'+tour.room+'</td>'+
						// '</tr>'+

						// '<tr>'+
						// 	'<td>Питание</td>'+
						// 	'<td id="food_type_'+j+'">'+tour.food_type+'</td>'+
						// '</tr>'+

						// '<tr>'+
						// 	'<td>Трансфер</td>'+
						// 	'<td id="transfer_'+j+'">'+tour.transfer+'</td>'+
						// '</tr>'+

						// '<tr>'+
						// 	'<td>Страховка от невыезда</td>'+
						// 	'<td id="noexit_insurance_'+j+'">'+tour.noexit_insurance+'</td>'+
						// '</tr>'+


						// (tour.noexit_insurance_people != null ? 

						// 	'<tr>'+
						// 		'<td>Кому оформляется стр-ка от невыезда</td>'+
						// 		'<td id="noexit_insurance_people_'+j+'">'+tour.noexit_insurance_people+'</td>'+
						// 	'</tr>'

						// 	: '')+

						// '<tr>'+
						// 	'<td>Мед. страховка</td>'+
						// 	'<td id="med_insurance_'+j+'">'+(tour.med_insurance == 1 ? 'Да' : 'Нет')+'</td>'+
						// '</tr>'+

						// '<tr>'+
						// 	'<td>Оформление визы</td>'+
						// 	'<td id="visa_'+j+'">'+tour.visa+'</td>'+
						// '</tr>'+

						// (tour.visa_people != null ?
						
						// '<tr>'+
						// 	'<td>Кому оформляется виза</td>'+
						// 	'<td id="visa_people_'+j+'">'+tour.visa_people+'</td>'+
						// '</tr>' 

						// : '')+

						// '<tr>'+
						// 	'<td>Экскурсия</td>'+
						// 	'<td id="sightseeing_'+j+'">'+tour.sightseeing+'</td>'+
						// '</tr>'+

						'<tr>'+
							'<td>Дополнительная информация</td>'+
							'<td id="extra_info_'+j+'" style="word-break: break-word">'+tour.extra_info+'</td>'+
						'</tr>'+


					'</table>'+

				'</div>'+

			'</div>'+

		'</div>';


	}