$(document).ready(function(){
	
	console.log('choose_doc.js loaded');

	$(document).on('change', 'select[class*="choose-doc"]', function () {


		var name = $(this).attr('name');

		var value = $(this).val(); 

		var row = $(this).closest('.row');

		var numbers = name.match(/\d+/g);

		var tourist_number = numbers[0];

		var doc_number = numbers[1];



		var id = '#doc_'+doc_number+'_div_'+tourist_number+'';

		var id_dates = '#doc_'+doc_number+'_div_dates_'+tourist_number+'';



		change_another_doc_select(tourist_number, doc_number, value);

		$('[name="doc_seria['+tourist_number+']['+doc_number+']"]').val('').removeAttr('disabled');
		$('[name="doc_number['+tourist_number+']['+doc_number+']"]').removeAttr('disabled');


		$('#russian_passport_row_'+tourist_number+'_'+doc_number+'').remove();

		$('input[name="date_expire['+tourist_number+']['+doc_number+']"]').removeAttr('disabled');


		$(id_dates).find('input').val('').removeAttr('zagran_ne_gotov').removeAttr('readonly');



		if(value == 'Загран. паспорт'||value == 'Внутррос. паспорт') {


			$(id).empty().append(

					'<div class="col-md-4 no-padding inline-block">'+
						
						'<input placeholder="Серия" class="form-control d-block-inline" name="doc_seria['+tourist_number+']['+doc_number+']" type="text">'+

					'</div>'+

					'<div class="col-md-8 no-padding inline-block padding-right-15">'+

						'<input placeholder="Номер" class="form-control d-block-inline" name="doc_number['+tourist_number+']['+doc_number+']" type="text">'+

					'</div>'



				);

			if(value == 'Внутррос. паспорт') {

				$('input[name="date_expire['+tourist_number+']['+doc_number+']"]').val('').attr('disabled', 'disabled');


				$(row).after(

					'<div class="row" id="russian_passport_row_'+tourist_number+'_'+doc_number+'">'+

						'<div class="form-group col-md-3">'+

							'<label for="who_issued[0][0]" class="control-label col-md-12 no-padding-right">Кем выдан?</label>'+

							'<div class="col-md-12">'+

								'<textarea placeholder="Кем выдан паспорт" class="form-control" id="extra_info" required="" name="who_issued['+tourist_number+']['+doc_number+']" cols="50" rows="4"></textarea>'+

							'</div>'+

						'</div>'+

						'<div class="form-group col-md-3">'+

							'<label for="address_pass[0][0]" class="control-label col-md-12 no-padding-right">Прописка</label>'+

							'<div class="col-md-12">'+

								'<textarea placeholder="Введите адрес по прописке в паспорте" class="form-control" id="address_pass" required="" name="address_pass['+tourist_number+']['+doc_number+']" cols="50" rows="4"></textarea>'+

							'</div>'+

						'</div>'+

					
						'<div class="form-group col-md-3">'+

							'<label for="address_real[0][0]" class="control-label col-md-12 no-padding-right">Факт. адрес</label>'+

							'<div class="col-md-12">'+

								'<textarea placeholder="Введите адрес" class="form-control" id="address_real" required="" name="address_real['+tourist_number+']['+doc_number+']" cols="50" rows="4"></textarea>'+

							'</div>'+

						'</div>'+

					'</div>'


					);

			}


		} 
		
		 else {


			if(value == 'Св-во о рождении') {

				$('input[name="date_expire['+tourist_number+']['+doc_number+']"]').val('').attr('disabled', 'disabled');


			}		 	


			$(id).empty().append(

						
					'<input placeholder="Серия" name="seria['+tourist_number+']['+doc_number+']" type="text" hidden value="0">'+


					'<div class="col-md-12 no-padding-left">'+
						
						'<input placeholder="Введите номер" class="form-control" name="doc_number['+tourist_number+']['+doc_number+']" type="text">' +

					'</div>'



				);

			
			if(value == 'Загран не готов') {

				zagran_ne_gotov(tourist_number, doc_number);

			}


		} 

	});


	function change_another_doc_select (tourist_number, doc_number, another_doc_value) {

		doc_number = (doc_number == 0) ? 1 : 0 ;

		var another_select_name = '[name="doc_type['+tourist_number+']['+doc_number+']"]';

		$(another_select_name).children('option:not(:first)').show();
		$(another_select_name).children('option[value="'+another_doc_value+'"]').hide();



	}


	// function zagran_ne_gotov(tourist_number, doc_number, msg=null) {




	// 	$('input[name="doc_number['+tourist_number+']['+doc_number+']"]').attr('readonly', 'readonly').attr('zagran_ne_gotov', 'zagran_ne_gotov');

	// 	$('input[name="date_issue['+tourist_number+']['+doc_number+']"]').val('1953-10-27').attr('readonly', 'readonly').attr('zagran_ne_gotov', 'zagran_ne_gotov');
	// 	$('input[name="date_expire['+tourist_number+']['+doc_number+']"]').val('3000-01-01').attr('readonly', 'readonly').attr('zagran_ne_gotov', 'zagran_ne_gotov');

	// 	// NOTE: Чтобы не удалялся аттрибут readonly, ввели спец аттрибут zagran_ne_gotov. В файле create_or_update_tour.js записали, чтобы это свойство не удалялось, когда 
	// 	// мы нажимаем кнопку "Нет, вернуться к редактированию" $("*").find('input:not([zagran_ne_gotov]), textarea').attr("readonly", "").removeAttr('readonly');
	// 	// if(msg != 'fill_all_fields') {

	// 	// 	insert_zagran_ne_gotov_number(tourist_number, doc_number);

	// 	// }

	// }

	// function insert_zagran_ne_gotov_number (tourist_number, doc_number) {

	// 	$.ajax({

	// 		type: 'post',
	// 		url: '/zagran_ne_gotov_number',

	// 	})

	// 	.done(function (data) {

	// 		$('input[name="doc_number['+tourist_number+']['+doc_number+']"]').val(data);

	// 	})

	// 	.fail(function() { 

	// 		alert('Произошла ошибка!');

	// 	})

	// }


})