
	console.log('fill_all_fields.js is loaded');




	function fill_all_fields(data) {

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

				    	if(! name.length == 0 ){

				    		if((name[0].nodeName == 'INPUT' && name.attr('type')!='checkbox') || (name[0].nodeName == 'TEXTAREA')) {

				    			name.val(tour[property]);
				    		
				    		} else if (name[0].nodeName =='SELECT') {

				    			if(property.includes('citizenship') && tour[property] != 'Россия') {

				    				var tourist_id  = property.replace('citizenship[', '').replace(']', '');

				    				$('#change_citezenship_'+tourist_id+'').trigger('click');

				    				console.log(tour[property]);
			
							    	name = $('[name="'+property+'"]');

							    	name.val(tour[property]);

				    			}

				    			name.val(tour[property]).change();

				    			// name.find('option[value="'+tour[property]+'"]').attr('selected', 'selected');

				    		}

				    		
				    	}


				    }
				}

	}

