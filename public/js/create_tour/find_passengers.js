	$(document).ready(function () {

		console.log('find_passengers.js loaded');


		
		$('[name="submit_find_passengers"]').on('click', function(event) {

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

						/// UN-CHECKING if SOME CHECKBOXES ARE CHEKCED

						$('[class*="inputs_0"]').find('*').val('');

						if($('#change_citezenship_0').is(":checked")) {

							$('#change_citezenship_0').trigger('click');
						}

						if($('#add_doc_2_0').is(":checked")) {

							$('#add_doc_2_0').trigger('click');
						}


						/// ADDING TOURIST FIELDS IF NEEDED

						fill_all_fields(data);

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



							}
							        
						}


					});

		});
	});