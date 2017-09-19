$(document).ready(function() {


	console.log("create_or_update_tour.js loaded");

	// AJAX REQUEST (TO ADD TOUR & PASSENGER OR TO GET VALIDATION ERROR)


				var verb;

				var button_send_data;


				$('#submit_button').click({value: 'create'}, function (event) {

					event.preventDefault();

					create_or_update(event.data.value); 


				});


				$('#update_button').click({value: 'update'}, function (event) {

					event.preventDefault();

					create_or_update(event.data.value); 

					// console.log('verb after function', verb);

				});



				function create_or_update(action) {

					var request = $('#tour_form, #passengers_form').serializeArray();

					// var request = $('#passengers_form').serializeArray();

					// var temp_for_doc_seria_values = [];

					
					// $(request).each(function (i, field) {
						
					// 	if(!(field.name.indexOf('doc_seria') == -1) ) {

					// 	var doc_id = field.name.replace('doc_seria', '');

					// 	var seria_length = field.value.length;

					// 	var seria_number = field.value;


					// 	temp_for_doc_seria_values.push({docnumber: "doc_number"+doc_id+"", seria_number: ""+seria_number+""});

					// 	request[] = { name: "seria"+doc_id+"", value: ""+seria_length+"" };



					// 	}


					// });


					// $(request).each(function (i, field) {
						
					// 	if(!(field.name.indexOf('doc_number') == -1)) {

					// 		$(temp_for_doc_seria_values).each(function (j, value) {
								
					// 			if (field.name == value.docnumber) {

					// 				field.value = value.seria_number.concat(field.value);
					// 			}

					// 		})
					// 	}

					// });


					console.log(request);



					if(action == 'create') {

						var url = '/tours_2/create';

						verb = "Создать";

						button_send_data = "#submit_button";


					} else if(action =='update') {

						request.push({name: 'tour_id', value: id});

						id = get_tour_id();

						var url = '/tours_2/'+id+'';

						verb = "Обновить ";

						button_send_data = "#update_button";



					}



						$('.p-error').each(function () {

							$(this).empty();
						})


					$.ajax({

						type: 'post',
						url: url,
						data: request,

						})

						.done(function (data) {

								// window.location.href = '/tours_2';

						})			

						.fail(function (data) {



							var errors = data.responseJSON;

							    	// console.log(errors);

							///CHANGING ERROR PROPERTIES FROM 'name=name.1'-kind to 'name=name[1]'-kind

							for (var property in errors) {
							    
							    if (errors.hasOwnProperty(property)) {

									if (property.includes('.')) {	

									    errors[property.replace(/\./, "[").replace(/\./, "][").replace(/$/, "]")]=errors[property];
								    	
								    	delete errors[property];



									}

							    }
							}

							console.log(errors);

							// Highlighting Tourists with passport-exists different-other-fields mistake ('Уже в базе')

							var index; // undefined;

							var execute_once = false;

							for (var property in errors) {
							    
							    if (errors.hasOwnProperty(property)) {

							    	if (digitexists = property.match(/\[\d+\]/g)) {

							    		if(errors[property][0].includes('В других заявках')) {


							    			if(!execute_once) {

								    			$(button_send_data).attr('value', ''+verb+' с изменением cуществующих туристов');

								    			$(button_send_data).after('<span> </span><button id="cancel_change_old_tourists" type="button" value="Отменить">Отменить</button>');

								    			$("input[name='cannot_change_old_tourists']").attr('value', 'false');



							    			}


							    			execute_once = true;


											digit = digitexists[0].replace(/\[|\]/g, '');

							    			if(index !== digit) {

							    				index = digit;
						    		
												$("div[class*='inputs_"+index+"']")
												.css('background-color', 'yellow')
												.after('<p id = "samepassportalert" style = "color:red">Внимание, турист с таким паспортом,'+
													'но другими данными, уже включен в другую заявку!</p>');

												$("div[class*='inputs_"+index+"']").find('input').attr("readonly", "");
												$("div[class*='inputs_"+index+"']").find("button").attr("disabled", "");


											}



							    		}

							   		 }

							    }
							}



							// ADDING ERRORS ON PAGE

							$('div[class*="alert-validation"]').remove();


							for (var property in errors) {

							    
							    if (errors.hasOwnProperty(property)) {





							    	if(property == 'is_tourist') {

									$('[name="'+property+'"]:last').after('<p class="p-error inline">'+' '+errors[property]+'</p>');


								    }

								    
									else if (property == 'tour_exists') {

								    $('div[class="input submit"]').append('<p class="p-error">'+' '+errors[property]+'</p>');


									}


									else {

								    // $('[name="'+property+'"]').after('<p class="p-error inline">'+' '+errors[property]+'</p>');

									
								    $('[name="'+property+'"]').parent('div').append('<div class="alert-validation">'+''+errors[property]+'</div>');
								    

									}

								}
							        
							}

							// MESSAGE ABOUT ERRORS NEAR "SUBMIT" BUTTON

							$('div[class="row submit"]').append('<div class="col-md-3 text-left"><div class="alert-validation">В форме есть ошибки! См. выше!</div></div>');

						});			

				};


		$(document).on('click', '#cancel_change_old_tourists', function() { 

			// console.log('verb inside cancel', verb);
			// console.log('button inside cancel', button_send_data);


			$('div[class*="inputs_"').css('background-color', 'yellow').css('background-color', 'white');

	    	$(button_send_data).attr('value', verb);

			$('#cancel_change_old_tourists').remove();

			$("input[name='cannot_change_old_tourists']").attr('value', 'true');

			$('p[id="samepassportalert"]').remove();

			$("div[class*='inputs_']").find('input').attr("readonly", "").removeAttr('readonly');
			$("div[class*='inputs_']").find('button').attr("disabled", "").removeAttr('disabled');


		});

});
