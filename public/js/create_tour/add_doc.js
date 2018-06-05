$(document).ready(function(){

	console.log('add_doc.js loaded');

	$(document).on('click', '[name="add_doc_2"]', function () {


		var tourist_number = $(this).attr('id').replace('add_doc_2_', '');

		var another_doc_type_value = $('[name="doc_type['+tourist_number+'][0]"]').val();
		


		if(this.checked) {

			$('#row_second_doc_'+tourist_number+' *').removeAttr('disabled');

			$('[name="doc_type['+tourist_number+'][1]"]').children('option[value="'+another_doc_type_value+'"]').hide();

		}

		else {

			$('#row_second_doc_'+tourist_number+' *').attr('disabled', 'disabled');

			$('#row_second_doc_'+tourist_number+' select:nth-child(1)').attr('selected', 'selected');

			$('#row_second_doc_'+tourist_number+' input').val('');

			$(this).removeAttr('disabled');

			// $('[name="doc_type['+tourist_number+'][1]"]').val('');

		}



	});


})



