
	console.log('fill_all_fields.js is loaded');




	function fill_all_fields(data) {


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

				    	if(property == 'is_buyer') { 

				    		$('[name="is_buyer"]:eq('+tour[property]+')').trigger('click');

							$('#is_tourist_'+tour.is_tourist+'').attr('checked', 'checked');

							delete tour.is_tourist;

				    	} else {
				    	 
				    	var name  = $('[name="'+property+'"]');

				    	if(! name.length == 0 ){



				    		if((name[0].nodeName == 'INPUT' && name.attr('type')!='checkbox') || (name[0].nodeName == 'TEXTAREA')) {

				    			name.val(tour[property]);

				    		} 

				    		else if(property.includes('cancel_patronymic') && tour[property] == '1') {

								$('input[name="'+property+'"]').trigger('click');

				    			// $("input[name='"+property+"']").attr('checked', 'checked');


				    		}

				    		else if (name[0].nodeName =='SELECT') {


				    			if(property.includes('citizenship') && tour[property] != 'Россия') {

				    				var tourist_id  = property.replace('citizenship[', '').replace(']', '');

				    				$('#change_citezenship_'+tourist_id+'').trigger('click');
			
							    	name = $('[name="'+property+'"]');

							    	name.val(tour[property]);

				    			} else if (property.includes('country') ) {

				    				name.val(tour[property]);

				    			 } else {

				    				name.val(tour[property]).change();

				    			}
				    		}

				    		
				    	}


						}

				    }
				}

			// $('[name="country"]').val(data.country); 
			// $('[name="airport"]').val(data.airport); alert("Airport"); 


	}

