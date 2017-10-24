$(document).ready(function(){
	
	console.log('choose_doc.js loaded');

	$(document).on('change', 'select[class*="choose-doc"]', function () {


		var name = $(this).attr('name');


		var value = $(this).val(); 


		var numbers = name.match(/\d+/g);

		var tourist_number = numbers[0];

		var doc_number = numbers[1];



		var id = '#doc_'+doc_number+'_div_'+tourist_number+'';

		var id_dates = '#doc_'+doc_number+'_div_dates_'+tourist_number+'';



		change_another_doc_select(tourist_number, doc_number, value);

		$('[name="doc_seria['+tourist_number+'][0]"]').removeAttr('disabled');
		$('[name="doc_number['+tourist_number+'][0]"]').removeAttr('disabled');


		if(value == 'Загран. паспорт'||value == 'Внутррос. паспорт') {


			$(id).empty().append(

					'<div class="col-md-4 no-padding inline-block">'+
						
						'<input placeholder="Серия" class="form-control d-block-inline" name="doc_seria['+tourist_number+']['+doc_number+']" type="text">'+

					'</div>'+

					'<div class="col-md-8 no-padding inline-block padding-right-15">'+

						'<input placeholder="Номер" class="form-control d-block-inline" name="doc_number['+tourist_number+']['+doc_number+']" type="text">'+

					'</div>'



				);




		} 



		 else {



			$(id).empty().append(

						
					'<input placeholder="Серия"  name="seria['+tourist_number+']['+doc_number+']" type="text" hidden value="0">'+


					'<div class="col-md-12 no-padding-left">'+
						
						'<input placeholder="Введите номер" class="form-control" name="doc_number['+tourist_number+']['+doc_number+']" type="text">' +

					'</div>'



				);


		} 

	});


	function change_another_doc_select (tourist_number, doc_number, another_doc_value) {

		doc_number = (doc_number == 0) ? 1 : 0 ;

		var another_select_name = '[name="doc_type['+tourist_number+']['+doc_number+']"]';

		$(another_select_name).children('option:not(:first)').show();
		$(another_select_name).children('option[value="'+another_doc_value+'"]').hide();



	}



})