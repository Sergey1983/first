$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("check_doc.js loaded");


	$(document).on('click', '#check_doc', function (event) {

		event.preventDefault();


		$('.p-error').each(function () {

			$(this).empty();
		})

		var tourist_fields = $(this).parent().parent();

		var doc_fullnumber_input =  $(this).parent().find('input[name*=doc_fullnumber]').val();	

		var block = $(this).parent();


		$.ajax ({
			type: 'POST',
			url: '/checkpassport_function',
			data: {doc_fullnumber: doc_fullnumber_input},

		})

		.done (function (data) {


			if(data!='not found') {

			var data = data[0];

			for (var property in data) {

				if (data.hasOwnProperty(property)) {

					 tourist_fields.find('input[name*='+property+']').val(data[property]);					

					}

				}

			} else { 

					 tourist_fields.find('input').val('');		

					 $('<div class="form-group" style="padding-left: 10px">'+
					 	'<span class="col-md-1"></span>'+
						'<div class="alert alert-warning col-md-3">'+
  							'Нет туриста с таким номером паспорта.'+ 
						'</div>'+
					   '</div>'
					).insertAfter(block).delay(1000).fadeOut();


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