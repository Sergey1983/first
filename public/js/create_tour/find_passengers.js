	$(document).ready(function () {

		console.log('find_passengers.js loaded');


		
		$('#submit_find_passengers').on('click', function(event) {

			event.preventDefault();
			
			$('p[class*="p-error"]').remove();

			$.ajax({
						type: 'post',
						url: '/find_passengers',
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

						    	$('<div class="form-group">'+
															
															'<div class="alert alert-warning" style="margin-left:5px">'+
																
																	''+errors[property]+''+ 
																
																'</div>'+

														'</div>').insertAfter(

															$('#submit_find_passengers').parent()

														).delay(1000).fadeOut();

								// $('<div class="alert alert-warning col-md-3 style="padding:10px">'+
			  			// 				''+errors[property]+''+ 
								// 	'</div>'
								// ).insertAfter($('#submit_find_passengers').closest('form')).delay(1000).fadeOut();


							    // $('#submit_find_passengers').after('<p class="p-error">'+errors[property]+'</p>');

							}
							        
						}

						// $('#submit_find_passengers').after('<p class="p-error">'+errors[0]+'</p>');

					});

		});
	});