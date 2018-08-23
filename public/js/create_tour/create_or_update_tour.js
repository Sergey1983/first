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

// console.log('1');


				if ($("input[name='all_disabled']").attr('value') == 'true') {


						var add_docs = $('[id^="add_doc_2_"]');

						var doc2_unchecked = ''; 

						$.each(add_docs, function (index, checkbox) {

							if(!checkbox.checked) {
							
								var number = $(checkbox).attr('id').replace('add_doc_2_', '');
								// doc2_checked = doc2_checked + '[id^="add_doc_2_"]:eq('+number+'), ';

								doc2_unchecked = doc2_unchecked + '[id^="row_second_doc_"]:eq('+number+') *, ';
								
							}

						});

						doc2_unchecked = doc2_unchecked.slice(0,-2);

						// console.log(doc2_unchecked);
				

						$("*").find('input:not([zagran_ne_gotov]), textarea').attr("readonly", "").removeAttr('readonly');
						$("*").find('button, select, [type="checkbox"], [type="radio"]').attr("disabled", "").removeAttr('disabled');

						$(doc2_unchecked).not('[name="add_doc_2"]').attr('disabled', 'disabled');


				}

// console.log('2');




					var request = $('#tour_form, #passengers_form').serializeArray();


					if(action == 'create') {

						var url = '/tours/create';

						verb = "Создать";

						button_send_data = "#submit_button";

						//Check for return_city value (set as "city_from" if absent). We dont' care for "Отельный", because there are no city_from, cicy_return...

						request = check_return_city(request);


					} else if(action =='update') {

						request.push({name: 'tour_id', value: id});

						// id = get_tour_id();

						id = $("#id").text();

						var url = '/tours/'+id+'';

						verb = "Обновить";

						button_send_data = "#update_button";

						//Check for return_city value (set as "city_from" if absent). We dont' care for "Отельный", because there are no city_from, cicy_return...

						request = check_return_city(request);



					}

					// console.log(request); return;

						$('.alert-validation').each(function () {

							$(this).empty();
						})


					// setTimeout(function(){
					// 	$(request).each(function(i, element) {console.log(i, element)});
					// 	console.log(request); 

					// }, 2000); return;

					// setTimeout( function() { 

						$.ajax({

						type: 'post',
						url: url,
						data: request,

						})

						.done(function (data) {

							console.log(data);

						// if(data == 'success')	{

						if(data.hasOwnProperty('success')) {

							if(action == 'create') {
							
								// window.location.href = '/tours';
								window.location.href = "/tours/"+data.tour_id+"/pay_tourist?&create=true";


							} else if( action == 'update') {

								window.location.href = "/tours/"+id+"";

							}

						} else if(data.hasOwnProperty('fatal_error')) {

						$("*").find('input, textarea').attr("readonly", "");
						$("*").find('button, select, [type="checkbox"], [type="radio"]').attr("disabled", "");
						$("input[name='all_disabled']").attr('value', 'true');


						$(button_send_data).attr('disabled', 'disabled');

						$('#divsubmit').append('<input id="cancel_change" class="inline btn btn-default" type="button" value="Вернуться к редактированию">');


							if(data.type == 'diff_docs') {


								$('[class*="inputs_'+data.tourist_number+' padding-all-10"]').append('<div class="row">'+

											'<div class="col-md-12">'+

												'<div class="alert-validation">Обработка заявки невозможна!</div>'+

												'<div class="alert-validation">'+data.message+'</div>'+

												'<div class="alert-validation">Документ-1 принадлежит туристу с id: '+data.ids[0]+'</div>'+

												'<div class="alert-validation">Документ-2 принадлежит туристу с id: '+data.ids[1]+'</div>'+

												'<div class="alert-validation">Нажмите на "Вернуться к редактированию" внизу страницы.</div>'+


											'</div>'+

										'</div>');



							} else if(data.type == 'sameid' || data.type == 'same_doc_type_and_number') {

								$.each(data.tourists_numbers, function (index, value) {


								$('[class="inputs_'+data.tourists_numbers[index]+' padding-all-10"]').append('<div class="row">'+

											'<div class="col-md-12">'+

												'<div class="alert-validation">Обработка заявки невозможна!</div>'+

												'<div class="alert-validation">'+data.message[index]+'</div>'+

												'<div class="alert-validation">Нажмите на "Вернуться к редактированию" внизу страницы.</div>'+


											'</div>'+

										'</div>');

								});

							} else if(data.type == 'already_exists') {

								$('#divsubmit').prepend('<div class="alert-validation">Обработка заявки невозможна!</div>'+

									'<div class="alert-validation">Уже существует тур с точно такими же значениями! Id заявки:'+data.same_tour_id+'</div>');


							}


						} else {

						$("input[name='allchecked']").attr('value', 'true');
						$("input[name='all_disabled']").attr('value', 'true');


						$("*").find('input, textarea').attr("readonly", "");
						$("*").find('button, select, [type="checkbox"], [type="radio"]').attr("disabled", "");

						$(button_send_data).attr('value', ''+verb+', применив изменения к существующим (см. выше)');
						$(button_send_data).attr('class', 'inline btn btn-warning');

						$('#divsubmit').append('<input id="cancel_change" class="inline btn btn-default" type="button" value="Нет, продолжить редактирование">');
						$('#divsubmit').prepend('<div class="alert-validation">Внимание! Посмотрите предупреждения выше, перед тем, как продолжать!</div>');



							var tourists = data.tourists;

							var documents = data.documents;

							// console.log(data.documents);


							// adding hidden CHECKINFO inputs for each tourist

							$.each(tourists, function (tourist_id, tourist) {

								$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_tourists['+tourist_id+'][exists]" hidden="hidden" value="'+tourist.check_info.exists+'">');


								if(tourist.check_info.exists == true && !tourist.check_info.hasOwnProperty('to_choose')) {


								$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_tourists['+tourist_id+'][id]" hidden="hidden" value="'+tourist.check_info.id+'">');


								} 

								if(tourist.check_info.hasOwnProperty('to_be_updated')) {

									$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_tourists['+tourist_id+'][to_be_updated]" hidden="hidden" value="'+tourist.check_info.to_be_updated+'">');


								}


								
								if (tourist.check_info.hasOwnProperty('differences')) {


									$.each(tourist.check_info.differences, function (property, value) {
									
										$('[name="'+property+'['+tourist_id+']"]').after('<div class="alert-validation">Сейчас в базе: '+value+'</div>');

									});

									$('[class*="inputs_'+tourist_id+'"]').append('<div class="row">'+

										'<div class="col-md-12">'+

											'<div class="alert-validation">Такой документ есть в базе и принадлежит другому туристу (см.выше). Если сохраните заявку, обновятся данные туриста в его прошлых заявках. Уверены, что хотите продолжить? (если не уверены - свяжитесь с главным менеджером, перед тем, как продолжить!)</div>'+

										'</div>'+

										'</div>');

									$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_tourists['+tourist_id+'][id]" hidden="hidden" value="'+tourist.check_info.id+'">');


								}

								if (tourist.check_info.hasOwnProperty('to_choose')) {


									$('[class*="inputs_'+tourist_id+'"]').append(

										'<div class="row choose_tourist_row">'+

										'<div class="col-md-8">'+

											'<div class="alert-validation">Турист с такими данными есть в базе. Выберите, добавить ему этот документ или создать нового туриста? </div>'+

											'<table class="table col-md-12">'+

												'<thead>'+

													'<tr>'+

														'<td class="padding-right-15">Id Туриста</td>'+

														'<td>#Предыдущей заявки</td>'+

														'<td>Дата отъезда</td>'+

														'<td>Страна пребывания</td>'+

														'<td>Отель</td>'+

														'<td>Выбрать</td>'+


													'</tr>'+

												'</thead>'+

												'<tbody id="choose_tourist_'+tourist_id+'">'+

												'<tr>'+

														'<td colspan="5" class="padding-right-15 text-right">Создать нового туриста?</td>'+

														'<td><input type="radio" name="check_info_tourists['+tourist_id+'][id]" value="new"></td>'+

													'</tr>'+

												'</tbody>'+

											'</div>'+

										'</div>');



										$.each(tourist.check_info.id, function (id, last_tour) {



											$('#choose_tourist_'+tourist_id+'').prepend('<tr>'+

														'<td class="padding-right-15">'+id+'</td>'+

														'<td>'+last_tour.last_tour.id+'</td>'+

														'<td>'+last_tour.last_tour.date_depart+'</td>'+

														'<td>'+last_tour.last_tour.country+'</td>'+

														'<td>'+last_tour.last_tour.hotel+'</td>'+

														'<td><input type="radio" name="check_info_tourists['+tourist_id+'][id]" value="'+id+'"></td>'+


													'</tr>'

												);

										});



								} 


							$.each(documents[tourist_id], function (document_id, doc) {


								$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_docs['+tourist_id+']['+document_id+'][exists]" hidden="hidden" value="'+doc.check_info.exists+'">');


								if (doc.check_info.hasOwnProperty('id')) {

									
									$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_docs['+tourist_id+']['+document_id+'][id]" hidden="hidden" value="'+doc.check_info.id+'">');


								}



								if (doc.check_info.hasOwnProperty('differences')) {

									$.each(doc.check_info.differences, function (property, value) {

										value = value == null ? 'нет значения' : value;

										value = value.replace(/(\d+)-(\d+)-(\d+)/, '$3\-$2\-$1');
									
										$('[name="'+property+'['+tourist_id+']['+document_id+']"]').after('<div class="alert-validation">Сейчас в базе: <br> '+value+'</div>');


										$('[class*="inputs_'+tourist_id+'"]').append('<div class="row">'+

											'<div class="col-md-12">'+

												'<div class="alert-validation">Такой документ есть в базе. У документа другие данные (см.выше)</div>'+

											'</div>'+

											'</div>');

										$('[class*="inputs_'+tourist_id+'"]').append('<input name="check_info_docs['+tourist_id+']['+document_id+'][to_be_updated]" hidden="hidden" value="'+doc.check_info.to_be_updated+'">');


									});

								}


					});










				});

			}






						})			

						.fail(function (data) {


							var errors = data.responseJSON;

console.log(errors);

							///CHANGING ERROR PROPERTIES FROM 'name=name.1'-kind to 'name=name[1]'-kind

							for (var property in errors) {
							    
							    if (errors.hasOwnProperty(property)) {

									if (property.includes('.')) {	
console.log(property);

									    errors[property.replace(/\./, "[").replace(/\./, "][").replace(/$/, "]")] = errors[property];
								    	
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

									$('[name="'+property+'"]:last').after('<p class="alert-validation">'+' '+errors[property]+'</p>');


								    }

								    
									else if (property == 'tour_exists') {

									    $('div[class="input submit"]').append('<p class="p-error">'+' '+errors[property]+'</p>');


									}

									else if (property.includes('rus_pas')) {

										console.log(property);

										var tourist_id = property.replace('rus_pas[', '').replace(']','');

										$('[class*="inputs_'+tourist_id+'"]').append('<p class="alert-validation">'+errors[property]+'</p>');

									}
									
									else if (property.includes('for_pas')) {

										console.log(property);

										var tourist_id = property.replace('for_pas[', '').replace(']','');

										$('[class*="inputs_'+tourist_id+'"]').append('<p class="alert-validation">'+errors[property]+'</p>');


									}


									else if (property.includes('check_info_tourists')) {

										console.log(property);

										var tourist_id = property.replace('check_info_tourists[', '').replace('][id]','');

										$('#choose_tourist_'+tourist_id+'').append('<p class="alert-validation">'+errors[property]+'</p>');


									}

									else {

									
									    $('[name="'+property+'"]').parent('div').append('<div class="alert-validation">'+''+errors[property]+'</div>');
								    

									} 



								}
							        
							}

							// MESSAGE ABOUT ERRORS NEAR "SUBMIT" BUTTON

							$('div[class="row submit"]').append('<div class="col-md-3 text-left"><div class="alert-validation">В форме есть ошибки! См. выше!</div></div>');

						});

						 // }, 2000);			

				};



		$(document).on('click', '#cancel_change', function() { 

			$('.alert-validation').remove();

			$('[name^="check_info"]').remove();

			$('[class*="choose_tourist_row"]').remove();

	    	$(button_send_data).removeAttr('disabled');
			$(button_send_data).attr('value', verb);
			$(button_send_data).attr('class', 'inline btn btn-success');

			$('#cancel_change').remove();

			$("input[name='allchecked']").attr('value', 'false');
			$("input[name='all_disabled']").attr('value', 'false');

			$('p[id="samepassportalert"]').remove();







			var add_docs = $('[id^="add_doc_2_"]');

			var doc2_unchecked = ''; 

			$.each(add_docs, function (index, checkbox) {

				if(!checkbox.checked) {
				
					var number = $(checkbox).attr('id').replace('add_doc_2_', '');
					// doc2_checked = doc2_checked + '[id^="add_doc_2_"]:eq('+number+'), ';

					doc2_unchecked = doc2_unchecked + '[id^="row_second_doc_"]:eq('+number+') *, ';
					
				}

			});

			doc2_unchecked = doc2_unchecked.slice(0,-2);

			console.log(doc2_unchecked);
	

			$("*").find('input:not([zagran_ne_gotov]), textarea').attr("readonly", "").removeAttr('readonly');
			$("*").find('button, select, [type="checkbox"], [type="radio"]').attr("disabled", "").removeAttr('disabled');

			$(doc2_unchecked).not('[name="add_doc_2"]').attr('disabled', 'disabled');

			// $('[id^="row_second_doc_"]:eq(1) *, [id^="row_second_doc_"]:eq(2) *').attr('disabled', 'disabled');

		});

});




