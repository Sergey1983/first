console.log('check_return_city.js loaded');

function check_return_city (request) {

	var city_return_add_extists = false;


			// console.log('typeof', typeof request);
			// console.log('1', request.length);


		if ( $('input[name="tour_type"]').val() != 'Отельный') {

			request[request.length] = {name: 'city_return', value: $('#city_from').val()};

			$(request).each(function(i, element) {

				// console.log(element);
				// console.log(element.name);

				if(element.name == 'city_return_add') {

					city_return_add_extists = true;

				}

			});


			if(city_return_add_extists) {

				request.splice(request.length-1, 1);

			} else {

			request[request.length] = {name: 'city_return_add', value: 0};

			}



		}  

			// console.log(request);
			// console.log('2', request.length);


		$('input[name^="cancel_patronymic"]').each(function (index, element) {

			if($(this).is(':not(:checked)')) {

			request[request.length] = {name: 'cancel_patronymic['+index+']', value: "0"};
			
			}

			

		});




		return request;


}