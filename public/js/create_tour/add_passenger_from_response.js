
				function add_passenger_from_response (data) {

					console.log('add_passenger_from_response.js loaded');


						/// ADDING TOURIST FIELDS IF NEEDED
						number_of_tourists = data.length;

						for (var i = 0; i < number_of_tourists-1; i++) {

							$('#add_passenger').trigger('click');

						}

						$.each(data, function (index, item) {

							/// FILLING IN ALL FIELDS
							for (var property in item) {
								
								 if (item.hasOwnProperty(property)) {

								 	$('[name="'+property+'['+index+']"]').val(item[property]);



									if(property == 'is_buyer') {

										 	if(item['is_buyer']==1) {

										 		$('input[name="is_buyer"][value="'+index+'"]').trigger('click');

										 		$('input[name="is_tourist"][value="'+item['is_tourist']+'"]').attr('checked', 'checked');

										       	

										 	}

									}

								 }
							}

						})


				}