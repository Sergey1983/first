console.log('check_return_city.js loaded');

function check_return_city (request) {


		if ( $('input[name="tour_type"]').val() != 'Отельный') {

			request[request.length] = {name: 'city_return', value: $('#city_from').val()};

			// console.log(request);

			$(request).each(function(i, element) {

				if(element.name == 'city_return_add') {

					city_return_add_extists = true;

					delete request[request.length-1];
				}

			});

		}  


		$('input[name^="cancel_patronymic"]').each(function (index, element) {

			if($(this).is(':not(:checked)')) {

			request[request.length] = {name: 'cancel_patronymic['+index+']', value: "0"};
			
			}

			

		});




		return request;


}