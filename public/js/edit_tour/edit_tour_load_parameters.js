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

			console.log(data);
			/// Tour info filling: 

			/// ADDING TOURIST FIELDS IF NEEDED
			number_of_tourists = data.number_of_tourists;

			for (var i = 0; i < number_of_tourists-1; i++) {

				$('#add_tourist').trigger('click');

			}

			/// MAKING 2ND DOC NON-DISABLED IF NEEDED

			for (var property in data.second_doc) {

				var tourist = data.second_doc[property];

				$('#add_doc_2_'+tourist+'').trigger('click');
			}


			var tour = data;
	
			for (var property in tour) {
				    
				    if (tour.hasOwnProperty(property)) {
				    	
				    	var name  = $('[name="'+property+'"]');

				    	// console.log(x);

				    	if(! name.length == 0 ){

				    		if((name[0].nodeName == 'INPUT' && name.attr('type')!='checkbox') || (name[0].nodeName == 'TEXTAREA')) {

				    			name.val(tour[property]);
				    		
				    		} else if (name[0].nodeName =='SELECT') {

				    			name.val(tour[property]).change();

				    			// name.find('option[value="'+tour[property]+'"]').attr('selected', 'selected');

				    		}

				    		
				    	}


				    }
				}



			// /// Tourists info filling: 

			// len = data.length;
			// var tourists = data.slice(1, len);

			// add_tourist_from_response(tourists);

			// // console.log(tourists);
	

		 })

		.fail(function() { 
			alert('Произошла ошибка!');
		})

});
