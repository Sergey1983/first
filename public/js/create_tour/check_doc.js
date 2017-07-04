$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("check_doc.js loaded");


	$(document).on('click', '.check_doc', function (event) {

		event.preventDefault();


		$('.p-error').each(function () {

			$(this).empty();
		})

		var tourist_fields = $(this).parent();

		var doc_fullnumber_input = $(this).parent().children('input[name*=doc_fullnumber]');	
		
		console.log(tourist_fields);	

		$.ajax ({
			type: 'POST',
			url: '/checkpassport_function',
			data: doc_fullnumber_input.serialize(),

		})

		.done (function (data) {

			var data = data[0];

			for (var property in data) {

				if (data.hasOwnProperty(property)) {




					tourist_fields.children('input[name*='+property+']').val(data[property]);

					

					}

				}

					
			// console.log(data);





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