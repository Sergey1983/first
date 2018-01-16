$(document).ready(function() {


	console.log("update_tour.js loaded");

	// AJAX REQUEST (TO ADD TOUR & PASSENGER OR TO GET VALIDATION ERROR)

				$('#update_button').click(function (event) {

					event.preventDefault();

					id = get_tour_id();

					update_tour_and_passengers();

					// console.log($('#tour_form, #passengers_form').serialize());




				});


				function update_tour_and_passengers () {

					$('.p-error').each(function () {

						$(this).empty();
					})

					var request = $('#tour_form, #passengers_form').serializeArray();
					
					request.push({name: 'tour_id', value: id});




					$.ajax({

						type: 'post',
						url: '/tours/'+id+'' ,
						data: request,

						})

						.done(function (data) {

							 console.log(data);

							window.location.href = '/tours';




						})			

						.fail(function (data) {

							var errors = data.responseJSON;

							///CHANGING ERROR PROPERTIES FROM 'name=name.1'-kind to 'name=name[1]'-kind

							for (var property in errors) {
							    
							    if (errors.hasOwnProperty(property)) {

									if (property.includes('.')) {	
									    errors[property.replace(/\./, "[").replace(/$/, "]")]=errors[property];
								    delete errors[property];


									}

							    }
							}


							// ADDING ERRORS ON PAGE

							for (var property in errors) {
							    
							    if (errors.hasOwnProperty(property)) {

							    	if(!(property == 'is_tourist') ) {

								    $('[name="'+property+'"]').after('<p class="p-error inline">'+errors[property]+'</p>');

								    }

								    /// ADDING MISTAKE FOR "IS_TOURIST" ONLY after "НЕТ"
								    
								else {

									$('[name="'+property+'"]:last').after('<p class="p-error inline">'+errors[property]+'</p>');

								}

								}
							        
							}

							// MESSAGE ABOUT ERRORS NEAR "SUBMIT" BUTTON

							$('#update_button').after("<p class='p-error'>В форме есть ошибки! См. выше!</p>");

						});			

				};

});
