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
	
			for (var property in tour) {
				    
				    if (tour.hasOwnProperty(property)) {
				    	
				    	var x  = $('[name="'+property+'"]');

				    	console.log(x);

				    	if(! x.length == 0 ){

				    		if((x[0].nodeName == 'INPUT' && x.attr('type')!='checkbox') || (x[0].nodeName == 'TEXTAREA')) {

				    			x.val(tour[property]);
				    		
				    		} else if (x[0].nodeName ==='SELECT') {

				    			x.find('option[value="'+tour[property]+'"]').attr('selected', 'selected');

				    		}

				    		
				    	}


				    }
				}

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
