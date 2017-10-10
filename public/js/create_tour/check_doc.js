$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("check_doc.js loaded");


	$(document).on('click', 'button[name^="check_doc_"]', function (event) {



		event.preventDefault();


		$('.alert-validation').each(function () {

			$(this).empty();
		})


		var tourist_number = Number($(this).attr('name').replace("check_doc_",''));


		var doc_number =  $('[name="doc_number['+tourist_number+'][0]"]').val();	

		var doc_seria =  $('[name="doc_seria['+tourist_number+'][0]"]').val();	

		var doc_type = $('[name="doc_type['+tourist_number+'][0]"]').val();	

		var parent = $(this).parents('div[class^="inputs_"]');


		if(doc_type.length == 0) {

			$('<div class="alert-validation">Выберите тип документа!</div>').appendTo(parent).fadeOut(2000);

			return false;
		}
		
		if(doc_number.length == 0) {

			$('<div class="alert-validation">Введите номер документа!</div>').appendTo(parent).fadeOut(2000);

			return false;
		}

		var doc_fullnumber_input = (typeof doc_seria != 'undefined' && doc_seria.length != 0) ? doc_seria+doc_number : doc_number;


		// var data = {doc_number: doc_fullnumber_input, doc_type: doc_type, tourist_number: tourist_number };

		// data = data.serialize();

		$.ajax ({
			type: 'POST',
			url: '/checkpassport_function',
			data: {'doc_number': doc_fullnumber_input,
				   'doc_type': doc_type,
				   'tourist_number': tourist_number },
			// data: data,

		})

		.done (function (data) {

			if(data != 'not found') {

			for (var property in data) {

				if (data.hasOwnProperty(property)) {


					 $("[name='"+property+"']").val(data[property]);					

					}

				}

			} else { 




			$('<div class="alert-validation">'+doc_type+' в базе отсутствует!</div>').appendTo(parent).fadeOut(3000);


			}

					





		})

		.fail (function (data) {
			
			var errors = data.responseJSON;

				for (var property in errors) {
	    
	            if (errors.hasOwnProperty(property)) {

		     		err = errors[property][0];

		     		doc_fullnumber_input.after('<p class="p-error inline">'+err+'</p>');

	            	}

	            }


			})


	});

});