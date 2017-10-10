$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("add_tourist.js loaded");


	$('#add_tourist').on('click', function (event) {

		event.preventDefault();

		var i = $("div[class*='inputs_']").length;

		$new_passenger = (

		'<div class="inputs_'+i+' padding">'+

			'<div class="row">'+

					'<div class="form-group col-md-3">'+
						'<label for="name['+i+']" class="control-label col-md-4">Имя</label>'+
						
						'<div class="col-md-8">'+
							'<input placeholder="Имя" class="form-control" name="name['+i+']" type="text" id="name['+i+']">'+
						'</div>'+

					'</div>'+


					'<div class="form-group col-md-3">'+
						'<label for="lastName['+i+']" class="control-label col-md-4">Фамилия</label>'+
						
						'<div class="col-md-8">'+
							'<input placeholder="Фамилия" class="form-control" name="lastName['+i+']" type="text" id="lastName['+i+']">'+
						'</div>'+

					'</div>'+

					'<div class="form-group col-md-3">'+

						'<button class="btn btn-default btn-grey col-md-4" id="transliterate_'+i+'" type="button" disabled="disabled">Трансл.<span class="glyphicon glyphicon-chevron-right"></span>'+
						'</button>'+

						'<div class="col-md-8">'+

							'<input placeholder="Imya" class="form-control " name="nameEng['+i+']" type="text">'+

						'</div>'+
						
					'</div>'+

					'<div class="form-group col-md-3">'+


						'<div class="col-md-8 no-padding-left">'+

							'<input placeholder="Familiya" class="form-control" name="lastNameEng['+i+']" type="text">'+

						'</div>'+

					'</div>'+


			'</div>'+

			'<div class="row">'+


				'<div class="form-group col-md-3 no-margin-bottom ">'+

					'<label for="birth_date['+i+']" class="control-label col-md-4">Дата рождения</label>'+

					'<div class="col-md-8">'+

					'<input placeholder="Дата рождения" class="form-control" name="birth_date['+i+']" type="date" id="birth_date['+i+']">'+
					
					'</div>'+

				'</div>'+

				'<div class="form-group col-md-3 no-margin-bottom">'+

					'<label for="citizenship['+i+']" class="control-label col-md-4">Гражданство</label>'+

					'<div class="col-md-8">'+

					'<select class="form-control" id="citizenship_'+i+'" name="citizenship['+i+']"><option value="Россия">Россия</option></select>'+

						'<div class="row text-right padding-right-15">'+
						
							'<small>Другое <input id="change_citezenship_'+i+'" name="change_citezenship" type="checkbox" value="1"></small>'+

						'</div>'+


					'</div>'+



				'</div>'+

				'<div class="col-md-6">'+

					'<div class="form-group col-md-3 no-padding-left padding-right-15">'+

						'<select class="form-control " name="gender['+i+']"><option selected="selected" hidden="hidden" value="">Пол</option><option value="Мужчина">Мужчина</option><option value="Женщина">Женщина</option></select>'+

					'</div>'+


					'<div class="form-group col-md-3">'+
						
						'<input placeholder="Телефон" class="form-control" name="phone['+i+']" type="text">'+

					'</div>'+


					'<div class="form-group col-md-4">'+


							'<input placeholder="Email" class="form-control" name="email['+i+']" type="text">'+

					'</div>'+

				'</div>'+




			'</div>'+


			'<div class="row">'+


				'<div class="form-group col-md-3">'+

					'<label for="doc_type['+i+'][0]" class="control-label col-md-4">Документ-1</label>'+

					'<div class="col-md-8">'+

						'<select class="form-control choose-doc" name="doc_type['+i+'][0]"><option selected="selected" hidden="hidden" value="">Выберите док-т</option><option value="Загран. паспорт">Загран. паспорт</option><option value="Внутррос. паспорт">Внутррос. паспорт</option><option value="Св-во о рождении">Св-во о рождении</option><option value="Другой документ">Другой документ</option></select>'+

						'</div>'+

				'</div>'+

				'<div class="form-group col-md-3" id="doc_0_div_'+i+'">'+

					'<div class="col-md-4 no-padding inline-block">'+
						
						'<input placeholder="Серия" class="form-control d-block-inline first-doc" disabled name="doc_seria['+i+'][0]" type="text">'+

					'</div>'+

					'<div class="col-md-8 no-padding inline-block padding-right-15">'+

						'<input placeholder="Номер" class="form-control d-block-inline first-doc" disabled name="doc_number['+i+'][0]" type="text">'+

					'</div>'+


				'</div>'+

				'<div class="col-md-6">'+

					'<div class="col-md-3  no-padding">'+

					'<button type="button" name="check_doc_'+i+'" class="btn btn-default btn-grey">Найти по паспорту<span class="glyphicon glyphicon-search"></span></button>'+

					'</div>'+

					'<div class="form-group col-md-3">'+

							'<input placeholder="Дата выдачи" class="form-control d-block-inline no-padding-right" id="date_issue_1" name="date_issue['+i+'][0]" type="date">'+
							'<small>Дата выдачи</small>'+

					'</div>'+

					'<div class="form-group col-md-3">'+

							'<input placeholder="Дата окончания" class="form-control d-block-inline no-padding-right" id="date_expire_1" name="date_expire['+i+'][0]" type="date">'+
							'<small>Дата окончания</small>'+

					'</div>'+

				'</div>'+



			'</div>'+

			'<div class="row" id="row_second_doc_'+i+'">'+


				'<div class="form-group col-md-3">'+

					'<label for="doc_type['+i+'][1]" class="control-label col-md-4">Документ-2</label>'+

					'<div class="col-md-8">'+

						'<select class="form-control choose-doc" disabled="" name="doc_type['+i+'][1]"><option selected="selected" hidden="hidden" value="">Выберите док-т</option><option value="Загран. паспорт">Загран. паспорт</option><option value="Внутррос. паспорт">Внутррос. паспорт</option><option value="Св-во о рождении">Св-во о рождении</option><option value="Другой документ">Другой документ</option></select>'+

						'<div class="row text-right padding-right-15">'+
						
							'<small>Нужен второй документ <input id="add_doc_2_'+i+'" name="add_doc_2" type="checkbox" value="1"></small>'+

						'</div>'+

					'</div>'+


				'</div>'+

				'<div class="form-group col-md-3" id="doc_1_div_'+i+'">'+

					'<div class="col-md-4 no-padding inline-block">'+
						
						'<input placeholder="Серия" class="form-control d-block-inline no-padding-right" disabled="disabled" name="doc_seria['+i+'][1]" type="text">'+

					'</div>'+

					'<div class="col-md-8 no-padding inline-block padding-right-15">'+

							'<input placeholder="Номер" class="form-control d-block-inline no-padding-right" disabled="disabled" name="doc_number['+i+'][1]" type="text">'+

					'</div>'+


				'</div>'+

				'<div class="col-md-6">'+

					'<div class="col-md-3 no-padding">'+

					// '<button type="button" name="check_doc['+i+'][1]" class="btn btn-default btn-grey" disabled="">Найти по паспорту<span class="glyphicon glyphicon-search"></span></button>'+

					'</div>'+

					'<div class="form-group col-md-3">'+

							'<input placeholder="Дата выдачи" class="form-control d-block-inline no-padding-right" disabled="disabled" id="date_issue_2" name="date_issue['+i+'][1]" type="date">'+
							'<small>Дата выдачи</small>'+

					'</div>'+

					'<div class="form-group col-md-3">'+

							'<input placeholder="Дата окончания" class="form-control d-block-inline no-padding-right" disabled="disabled" id="date_expire_2" name="date_expire['+i+'][1]" type="date">'+
							'<small>Дата окончания</small>'+

					'</div>'+

				'</div>'+

			'</div>'+



			'<div class="row" id="payer">'+

				'<div class="form-group col-md-6">'+
					
					'<label for="Заказчик?" class="col-md-2">Заказчик?</label>'+

					'<div class="col-md-1 text-left">'+

						'<input name="is_buyer" type="radio" value="'+i+'">'+

					'</div>'+

				'</div>'+

			'</div>'+

		
			'<div class="row" id="delete_tourist">'+

					'<div class="form-group col-md-6">'+
						
						'<button class="inline btn btn-default delete_tourist" type="button">Удалить туриста</button>'+
			
					'</div>'+

			'</div>'+




		'</div>'





			);




		$('.inputs_'+(i-1)+'').after($new_passenger);
				
		i+=1;


	});

});