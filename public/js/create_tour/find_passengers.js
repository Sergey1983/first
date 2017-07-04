	$(document).ready(function () {

		console.log('find_passengers.js loaded');


		
		$('#submit_find_passengers').on('click', function(event) {

			event.preventDefault();
			
			$('p[class*="p-error"]').remove();

			$.ajax({
						type: 'post',
						url: '/tours_2/find_passengers',
						data: $('#find_passengers').serialize(),
					})

					.done(function (data) {


						/// DELETING ALL PASSENGERS EXCEPT 1 

						var passengers_count = $("div[class*='inputs_']").length;

						var div_inputs = $("div[class*='inputs_']");

						div_inputs.each(function (index, elem) {
							
							if (index!=0) {

								$(elem).remove();
							}

						})

						/// ADDING TOURIST FIELDS IF NEEDED

						add_passenger_from_response (data);

					})

					.fail(function (data) {

						var errors = data.responseJSON;

						for (var property in errors) {
							    
						    if (errors.hasOwnProperty(property)) {

							    $('#submit_find_passengers').after('<p class="p-error">'+errors[property]+'</p>');

							}
							        
						}

						// $('#submit_find_passengers').after('<p class="p-error">'+errors[0]+'</p>');

					});

		});
	});