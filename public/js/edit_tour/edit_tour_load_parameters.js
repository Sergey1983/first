$(document).ready(function() {
	
	console.log('edit_tour_load_param.js loaded');

	// Get Tour id
	
	id = get_tour_id();
		

	// Get tour params:

		$.ajax({
			type: 'post',
			url: '/edit_tour_prepare_data',
			data: {0: id}, 
		})

		.done(function(data) {


			/// Tour info filling: 

			var tour = data[0];
			$('input[name=hotel]').val(tour['hotel']);
			$('option[value='+tour['city_from']+']').attr('selected', 'selected');

			/// Tourists info filling: 

			len = data.length;
			var tourists = data.slice(1, len);

			add_passenger_from_response(tourists);

			// console.log(tourists);
	

		 })

		.fail(function() { 
			alert('Произошла ошибка!');
		})

});
