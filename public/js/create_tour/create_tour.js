$(document).ready(function() {


	console.log("create_tour.js loaded");

	// AJAX REQUEST (TO ADD TOUR & PASSENGER OR TO GET VALIDATION ERROR)

				$('#submit_button').click(function (event) {

					event.preventDefault();

					add_tour_and_passengers();

					console.log($('#tour_form, #passengers_form').serialize());



				function add_tour_and_passengers () {

					$('.p-error').each(function () {

						$(this).empty();
					})



					$.ajax({

						type: 'post',
						url: '/tours_2/create',
						data: $('#tour_form, #passengers_form').serialize(),

						})

						.done(function (data) {

							// console.log(data);

							window.location.href = '/tours_2';




						})			

						.fail(function (data) {

							var errors = data.responseJSON;

							console.log(errors);

							///CHANGING ERROR PROPERTIES FROM 'name=name.1'-kind to 'name=name[1]'-kind

							for (var property in errors) {
							    
							    if (errors.hasOwnProperty(property)) {

									if (property.includes('.')) {	
									    errors[property.replace(/\./, "[").replace(/$/, "]")]=errors[property];
								    delete errors[property];


									}

							    }
							}


							// console.log(errors);

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

							$('#submit_button').after("<p class='p-error'>В форме есть ошибки! См. выше!</p>");

						});			

				};

		});
});
