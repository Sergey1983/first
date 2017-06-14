$(document).ready(function() {


	console.log("Script_2");

	// AJAX REQUEST (TO ADD TOUR & PASSENGER OR TO GET VALIDATION ERROR)

				// $('#submit_button').click(function (event) {

				// 	event.preventDefault();

				// 	add_tour_and_passengers();

	
				// });



				// function add_tour_and_passengers () {

				// 	$('.p-error').each(function () {
				// 		$(this).empty();
				// 	})



				// 	$.ajax({

				// 		type: 'post',
				// 		url: '/tours_2/create',
				// 		data: $('#tour_and_passengers_form').serialize(),
				// 		})

				// 		.done(function () {


				// 			window.location.href = "{{ URL::to('tours_2') }}";


				// 		})			

				// 		.fail(function (data) {

				// 			var errors = data.responseJSON;


				// 			for (var property in errors) {
							    
				// 			    if (errors.hasOwnProperty(property)) {

				// 					if (property.includes('.')) {	
				// 					    errors[property.replace(/\./, "[").replace(/$/, "]")]=errors[property];
				// 				    delete errors[property];


				// 					}

				// 			    }
				// 			}


				// 			for (var property in errors) {
							    
				// 			    if (errors.hasOwnProperty(property)) {

				// 				    $('[name="'+property+'"]').after('<p class="p-error inline">'+errors[property]+'</p>');

				// 					}
							        
				// 			    }

				// 		});			

				// };

});