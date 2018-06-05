	console.log('initial_functions.js loaded');

	function zagran_ne_gotov(tourist_number, doc_number, msg=null) {

		// alert('hi');

		if(msg == 'fill_all_fields') {


			// We repeat this code from choose_doc.js, because it's initialized by change() event which we don't use in all_all_fields for 'Загран не готов'

			var id = '#doc_'+doc_number+'_div_'+tourist_number+'';


			$(id).empty().append(

						
					'<input placeholder="Серия" name="seria['+tourist_number+']['+doc_number+']" type="text" hidden value="0">'+


					'<div class="col-md-12 no-padding-left">'+
						
						'<input placeholder="Введите номер" class="form-control" name="doc_number['+tourist_number+']['+doc_number+']" type="text">' +

					'</div>'



				);


			$('select[name="doc_type['+tourist_number+']['+doc_number+']"]').val('Загран не готов');


		}
		
		$('input[name="doc_number['+tourist_number+']['+doc_number+']"]').attr('readonly', 'readonly').attr('zagran_ne_gotov', 'zagran_ne_gotov');

		$('input[name="date_issue['+tourist_number+']['+doc_number+']"]').val('1953-10-27').attr('readonly', 'readonly').attr('zagran_ne_gotov', 'zagran_ne_gotov');
		$('input[name="date_expire['+tourist_number+']['+doc_number+']"]').val('3000-01-01').attr('readonly', 'readonly').attr('zagran_ne_gotov', 'zagran_ne_gotov');

		// NOTE: Чтобы не удалялся аттрибут readonly, ввели спец аттрибут zagran_ne_gotov. В файле create_or_update_tour.js записали, чтобы это свойство не удалялось, когда 
		// мы нажимаем кнопку "Нет, вернуться к редактированию" $("*").find('input:not([zagran_ne_gotov]), textarea').attr("readonly", "").removeAttr('readonly');
		if(msg != 'fill_all_fields') {

			insert_zagran_ne_gotov_number(tourist_number, doc_number);

		}

	}

	function insert_zagran_ne_gotov_number (tourist_number, doc_number) {

		$.ajax({

			type: 'post',
			url: '/zagran_ne_gotov_number',

		})

		.done(function (data) {

			$('input[name="doc_number['+tourist_number+']['+doc_number+']"]').val(data);

		})

		.fail(function() { 

			alert('Произошла ошибка!');

		})

	}