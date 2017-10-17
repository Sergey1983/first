$(document).ready(function() {

	console.log('fill_versions.js loaded');


	var id = get_tour_id_for_versions();

	$.ajax({
			type: 'post',
			url: '/return_versions',
			data: {'id': id}, 
		})

		.done(
			function(data) {

				console.log(data);

			var number_of_versions = Object.keys(data).length;


			$('[class="nav nav-tabs"]').append('<li class="active"><a data-toggle="tab" href="#version1">Версия 1</a></li>');
			$('[class="tab-content"]').append('<div class="tab-pane fade in active" id="version1">');

			for(i=1; i<number_of_versions; i++){

				var j = i+1;
				$('[class="nav nav-tabs"]').append('<li><a data-toggle="tab" href="#version'+j+'">Версия '+j+'</a></li>');
				$('[class="tab-content"]').append('<div class = "tab-pane fade" id="version'+j+'">');
			
			}

			for(i=0; i<number_of_versions; i++){



				var j = i+1;

				console.log('number of version'+j+'');

				var tour = data[j].tour;

				var tourists = data[j].tourists;

				// console.log(tourists);

				var number_of_tourists = Object.keys(tourists).length;


				if (tour.date_hotel ==0 ) {
					
					var date_hotel = new Date(tour.date_depart);

					date_hotel.setDate(date_hotel.getDate() + 1);

					var dd = date_hotel.getDate();
					dd = (dd < 10) ? '0' + dd : dd;
					var mm = date_hotel.getMonth() + 1;
					var yyyy = date_hotel.getFullYear();

					var date_hotel = dd + '-'+ mm + '-'+ yyyy;					

				}



				$('#version'+j+'').append(




'<div class="container-fluid">'+
	
	'<div class="row">'+
		
		'<div class="col-md-6">'+
			
			'<table class="table table-responsive table-bordered table-striped col-md-12">'+


			'<tr>'+

					'<th colspan="2">Параметры заявки</th>'+

				'</tr>'+


					'<tr>'+
						'<td class="col-md-6">Номер заявки</td>'+
						'<td>'+tour.tour_id+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Время подачи заявки</td>'+
						'<td>'+tour.created_at+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Менеджер создавший</td>'+
						'<td>'+tour.user_name+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Источник заявки</td>'+
						'<td>'+tour.source+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Туроператор</td>'+
						'<td>'+tour.operator+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Номер заявки у поставщика</td>'+
						'<td>'+tour.operator_code+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Валюта тура</td>'+
						'<td>'+tour.currency+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Стоимость для туриста ('+(tour.price != null ? tour.currency+' / RUB' : 'RUB')+')</td>'+
						'<td>'+ (tour.price != null ? tour.price+' / '+tour.price_rub : tour.price_rub) +' </td>'+
					'</tr>'+



					'<tr>'+
						'<td>Долг туриста</td>'+
						'<td>-</td>'+
					'</tr>'+


					'<tr>'+
						'<td>К оплате оператору (RUB)</td>'+
						'<td>' + (tour.operator_price_rub == null ? 'Заявка еще не подтверждена' : tour.operator_price_rub) + '</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Комиссия (RUB)</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Срок полной оплаты опер-ру</td>'+
						'<td>'+(tour.operator_full_pay == null ? 'Заявка ещё не подтверждена' : tour.operator_full_pay)+'</td>'+
					'</tr>'+


					'<tr>'+
						'<td>Срок частичной оплаты опер-ру</td>'+
						'<td>'+(tour.operator_part_pay == null ? 'Заявка ещё не подтверждена': tour.operator_part_pay)+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Статус оплаты оператору</td>'+
						'<td>-</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Оплата в кредит?</td>'+
						'<td>'+(tour.first_payment==null ? 'Нет': 'Да')+'</td>'+
					'</tr>'+

					(tour.first_payment!=null ?


					'<tr>'+
						'<td>Первый взнос за кредит</td>'+
						'<td>'+tour.first_payment+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>Банк-кредитор</td>'+
						'<td>'+tour.bank+'</td>'+
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
							'<td>'+tour.city_from+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Cтрана пребывания</td>'+
							'<td>'+tour.country+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Аэропорт прибытия</td>'+					
		 					'<td>'+tour.airport+'</td>'+	
		 				'</tr>'+

						'<tr>'+
							'<td>Пребывание с </td>'+
							'<td>'+tour.date_depart+'</td>'+
						'</tr>'+


						'<tr>'+
							'<td>Пребывание в отеле</td>'+
							'<td>'+(tour.date_hotel == null ? tour.date_depart : date_hotel)+'</td>'+
						'</tr>'+


						'<tr>'+
							'<td>Ночей в отеле</td>'+
							'<td>'+tour.nights+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Отель </td>'+
							'<td>'+tour.hotel+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Количество туристов</td>'+
							'<td>'+tourists.length+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Номера</td>'+
							'<td>'+tour.room+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Питание</td>'+
							'<td>'+tour.food_type+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Трансфер</td>'+
							'<td>'+tour.transfer+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Страховка от невыезда</td>'+
							'<td>'+tour.noexit_insurance+'</td>'+
						'</tr>'+


						(tour.noexit_insurance_people != null ? 

							'<tr>'+
								'<td>Кому оформляется стр-ка от невыезда</td>'+
								'<td>'+tour.noexit_insurance_people+'</td>'+
							'</tr>'

							: '')+

						'<tr>'+
							'<td>Мед. страховка</td>'+
							'<td>'+(tour.med_insurance == 1 ? 'Да' : 'Нет')+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Оформление визы</td>'+
							'<td>'+tour.visa+'</td>'+
						'</tr>'+

						(tour.visa_people != null ?
						
						'<tr>'+
							'<td>Кому оформляется виза</td>'+
							'<td>'+tour.visa_people+'</td>'+
						'</tr>' 

						: '')+

						'<tr>'+
							'<td>Экскурсия</td>'+
							'<td>'+tour.sightseeing+'</td>'+
						'</tr>'+

						'<tr>'+
							'<td>Дополнительная информация</td>'+
							'<td style="word-break: break-word">'+tour.extra_info+'</td>'+
						'</tr>'+


					'</table>'+

				'</div>'+

			'</div>'+

		'</div>'

				);


				// $('#version'+j+'').append('<div class="container-fluid">');
		
				for(n=0; n<number_of_tourists; n++) {

					var tourist = tourists[n];


					console.log(tourist);

					m = n+1;

					$('#version'+j+'').append(

					'<div class="container-fluid">'+

						'<h4>Турист '+m+':</h4>'+


						'<div class="row" id="row_tourist_and_documents_'+j+'_'+m+'">'+

							'<div class="col-md-12">'+
							
								'<table class="table table-responsive table-bordered table-striped">'+

									'<tr>'+

									    '<th>Id</th>'+
									    '<th>Имя</th>'+
									    '<th>Фамилия</th>'+
									    '<th>Имя Англ.</th>'+
									    '<th>Фамилия Англ.</th>'+
									    '<th>День рож-я</th>'+
									    '<th>Гражданство</th>'+
									    '<th>Пол</th>'+
									    '<th>Телефон</th>'+
									    '<th>Email</th>'+

									'</tr>'+

									'<tr>'+

									    '<td>'+tourist.id+'</td>'+
									    '<td>'+tourist.name+'</td>'+
									    '<td>'+tourist.lastName+'</td>'+
									    '<td>'+tourist.nameEng+'</td>'+
									    '<td>'+tourist.lastNameEng+'</td>'+    
									    '<td>'+tourist.birth_date+'</td>'+
									    '<td>'+tourist.citizenship+'</td>'+
									    '<td>'+tourist.gender+'</td>'+
									    '<td>'+tourist.phone+'</td>'+
									    '<td>'+tourist.email+'</td>'+


									'</tr>'+

								'</table>'+

							'</div>'

						// '</div>'



					);


				var documents = tourist.docs;

				console.log(documents);
				
				var number_of_documents  = 	Object.keys(documents).length;


					for (k = 0; k< number_of_documents; k++) {


						var document = documents[k];

							// $('#version'+j+'').append(

				$("#row_tourist_and_documents_"+j+"_"+m+"").append(


								'<div class="col-md-6">'+

										'<table class="table table-responsive table-bordered table-striped">'+

											'<tr>'+

											    '<th class="col-md-4">Тип док-а 1</th>'+
											    '<th class="col-md-4">Номер док-а</th>'+
											    '<th class="col-md-2">Дата выдачи</th>'+
											    '<th class="col-md-2">Дата окон-я</th>'+

											'</tr>'+

											'<tr>'+

											    '<td>'+document.doc_type+'</td>'+
											    '<td>'+document.doc_number+'</td>'+
											    '<td>'+document.date_issue+'</td>'+
											    '<td>'+document.date_expire+'</td>'+
											
											'</tr>'+


										'</table>'+

								'</div>'


								);

					}


					if(data[j].buyer.is_buyer == n) {

$("#row_tourist_and_documents_"+j+"_"+m+"").append(


	'<div class="row">'+

		'<div class="col-md-12">'+


			'<div class="col-md-6">'+

					'<table class="table table-responsive table-bordered table-striped">'+

						'<tr>'+

						    '<th class="col-md-4">Это заказчик?</th>'+
						    '<th class="col-md-4">Закачик едет в тур?</th>'+

						'</tr>'+

						'<tr>'+

						    '<td>Да</td>'+
						    '<td>'+(data[j].buyer.is_tourist == 1 ? 'Да, едет' : 'Нет, не едет')+'</td>'+

						
						'</tr>'+


					'</table>'+

			'</div>'+

		'</div>'+

	'</div>'

);





					}


					// $('#version'+j+'').append('</div></div>');


				}


			}

		})

		.fail( 
			function(data){



			});





});
