function check_return_city (request) {

					request[request.length] = {name: 'city_return', value: $('#city_from').val()};

					console.log(request);

					$(request).each(function(i, element) {

						if(element.name == 'city_return_add') {

							city_return_add_extists = true;

							delete request[request.length-1];
						}

					});

					return request;

					}