$(document).ready(function(){
	

	$(document).on('change', 'select[name*="doc_1_type"]', function () {

		var number = $(this).attr('name').replace(/doc_1_type\[/, '').replace(/]/, '');
		
		var value = $(this).val(); 

		var id = '#doc_1_div_'+number+'';

		var id_dates = '#doc_1_div_dates_'+number+'';


		if(value == 'Загран. паспорт') {

			$(id).empty().append(

					'<div class="col-md-4 no-padding inline-block">'+
						
						'<input placeholder="Серия" class="form-control d-block-inline" name="trvl_passport_ser['+number+']" type="text">'+

					'</div>'+

					'<div class="col-md-8 no-padding inline-block padding-right-15">'+

						'<input placeholder="Номер" class="form-control d-block-inline" name="trvl_passport_num['+number+']" type="text">'+

					'</div>'



				);

			$('#date_issue').attr('name', 'trvl_passport_issued');
			$('#date_expire').attr('name', 'trvl_passport_expires');



		} else if (value == 'Внутррос. паспорт') {

			$(id).empty().append(

					'<div class="col-md-4 no-padding inline-block">'+
						
						'<input placeholder="Серия" class="form-control d-block-inline" name="inner_passport_ser['+number+']" type="text">'+

					'</div>'+

					'<div class="col-md-8 no-padding inline-block padding-right-15">'+

						'<input placeholder="Номер" class="form-control d-block-inline" name="inner_passport_num['+number+']" type="text">'+

					'</div>'

				);

			$('#date_issue').attr('name', 'inner_passport_issued');
			$('#date_expire').attr('name', 'inner_passport_expires');


		} else if (value == 'Св-во о рождении') {

			$(id).empty().append(

					'<div class="col-md-12 no-padding-left">'+
						
						'<input placeholder="Введите св-во о рождении" class="form-control" name="birth_doc['+number+']" type="text" id="birth_doc['+number+']">' +

					'</div>'



				);

			$('#date_issue').attr('name', 'birth_doc_issued');
			$('#date_expire').attr('name', 'birth_doc_expires');


		} else if(value == 'Другой документ') {

			$(id).empty().append(

					'<div class="col-md-12 no-padding-left">'+
						
						'<input placeholder="Введите номер документа" class="form-control" name="other_doc['+number+']" type="text" id="other_doc['+number+']">' +

					'</div>'



				);

			$('#date_issue').attr('name', 'other_doc_issued');
			$('#date_expire').attr('name', 'other_doc_expires');

		}

	});



})