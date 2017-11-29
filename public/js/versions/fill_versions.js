$(document).ready(function() {

	console.log('fill_versions.js loaded');


	var UURRLL = document.location.toString();

	var id = get_tour_id_for_versions();

	$.ajax({
			type: 'post',
			url: '/return_versions',
			data: {'id': id}, 
		})

		.done(
			function(data) {

				console.log(data);

			var number_of_versions = Object.keys(data).length;


			$('[class="nav nav-tabs"]').append('<li class="active"><a data-toggle="tab" href="#version1">Версия 1</a></li>');
			$('[class="tab-content"]').append('<div class="tab-pane fade in active" id="version1">');

			for(i=1; i<number_of_versions; i++){

				var last_version = number_of_versions - 1;
				var j = i+1;
				$('[class="nav nav-tabs"]').append('<li><a data-toggle="tab" href="#version'+j+'">'+(i != last_version ? 'Версия '+j+'' : 'Текущая версия')+' </a></li>');
				$('[class="tab-content"]').append('<div class = "tab-pane fade" id="version'+j+'">');
			
			}

			for(i=0; i<number_of_versions; i++){



				var j = i+1;

				// console.log('number of version'+j+'');

				var tour = data[j].tour;

				var tourists = data[j].tourists;



				// console.log(tourists);

				var number_of_tourists = Object.keys(tourists).length;


				if (tour.date_hotel ==0 ) {
					
					var date_hotel = new Date(tour.date_depart);

					date_hotel.setDate(date_hotel.getDate() + 1);

					var dd = date_hotel.getDate();
					dd = (dd < 10) ? '0' + dd : dd;
					var mm = date_hotel.getMonth() + 1;
					var yyyy = date_hotel.getFullYear();

					var date_hotel = dd + '-'+ mm + '-'+ yyyy;				

				}



				var tour_info_html = get_tour_info_for_versions(j, data, tour, tourists, date_hotel);

				$('#version'+j+'').append(tour_info_html);








				// $('#version'+j+'').append('<div class="container-fluid">');
		
				for(n=0; n<number_of_tourists; n++) {

					var tourist = tourists[n];


					// console.log(tourist);

					m = n+1;

					$('#version'+j+'').append(

					'<div class="container-fluid" id="container_tourist_and_documents_'+j+'_'+m+'"">'+

						'<h4>Турист '+m+':</h4>'+


						'<div class="row" id="row_tourist_and_documents_'+j+'_'+m+'">'+

							'<div class="col-md-12">'+
							
								'<table class="table table-responsive table-bordered table-striped">'+

									'<tr>'+

									    '<th>Id</th>'+
									    '<th>Имя</th>'+
									    '<th>Фамилия</th>'+
									    '<th>Имя Англ.</th>'+
									    '<th>Фамилия Англ.</th>'+
									    '<th>День рож-я</th>'+
									    '<th>Гражданство</th>'+
									    '<th>Пол</th>'+
									    '<th>Телефон</th>'+
									    '<th>Email</th>'+

									'</tr>'+

									'<tr>'+

									    '<td>'+tourist.id+'</td>'+
									    '<td id="name_'+j+'_'+m+'">'+tourist.name+'</td>'+
									    '<td id="lastName_'+j+'_'+m+'">'+tourist.lastName+'</td>'+
									    '<td id="nameEng_'+j+'_'+m+'">'+tourist.nameEng+'</td>'+
									    '<td id="lastNameEng_'+j+'_'+m+'">'+tourist.lastNameEng+'</td>'+    
									    '<td id="birth_date_'+j+'_'+m+'">'+tourist.birth_date+'</td>'+
									    '<td id="citizenship_'+j+'_'+m+'">'+tourist.citizenship+'</td>'+
									    '<td id="gender_'+j+'_'+m+'">'+tourist.gender+'</td>'+
									    '<td id="phone_'+j+'_'+m+'">'+tourist.phone+'</td>'+
									    '<td id="email_'+j+'_'+m+'">'+tourist.email+'</td>'+


									'</tr>'+

								'</table>'+

							'</div>'

						// '</div>'



					);


				var documents = tourist.docs;

				// console.log(documents);
				
				var number_of_documents  = 	Object.keys(documents).length;


					for (k = 0; k< number_of_documents; k++) {

						var l = k+1;

						var document = documents[k];

				$("#row_tourist_and_documents_"+j+"_"+m+"").append("<div id='div_documents_"+j+"_"+m+"'>");


				// $("#row_tourist_and_documents_"+j+"_"+m+"").append(

					$("#div_documents_"+j+"_"+m+"").append(

								'<div class="col-md-6" id="div_document_'+j+'_'+m+'_'+l+'">'+

										'<table class="table table-responsive table-bordered table-striped">'+

											'<tr>'+

											    '<th class="col-md-4">Тип док-а 1</th>'+
											    '<th class="col-md-4">Номер док-а</th>'+
											    '<th class="col-md-2">Дата выдачи</th>'+
											    '<th class="col-md-2">Дата окон-я</th>'+

											'</tr>'+

											'<tr>'+

											    '<td>'+document.doc_type+'</td>'+
											    '<td>'+document.doc_number+'</td>'+
											    '<td id="date_issue_'+j+'_'+m+'_'+l+'">'+document.date_issue+'</td>'+
											    '<td id="date_expire_'+j+'_'+m+'_'+l+'">'+document.date_expire+'</td>'+
											
											'</tr>'+


										'</table>'+

								'</div>'


								);

					}


					if(data[j].buyer.is_buyer == n) {

$("#row_tourist_and_documents_"+j+"_"+m+"").append(


	'<div class="row" id="div_buyer_'+j+'">'+

		'<div class="col-md-12">'+


			'<div class="col-md-6">'+

					'<table class="table table-responsive table-bordered table-striped">'+

						'<tr>'+

						    '<th class="col-md-4">Это заказчик?</th>'+
						    '<th class="col-md-4">Закачик едет в тур?</th>'+

						'</tr>'+

						'<tr>'+

						    '<td>Да</td>'+
						    '<td id="is_tourist_'+j+'">'+(data[j].buyer.is_tourist == 1 ? 'Да, едет' : 'Нет, не едет')+'</td>'+

						
						'</tr>'+


					'</table>'+

			'</div>'+

		'</div>'+

	'</div>'

);





					} /// end Docs-iteration


					// $('#version'+j+'').append('</div></div>');


				} /// end Tourist-iteration




			if(('number_of_tourists_changed' in data[j])) {

				$('#number_of_tourists_'+j+'').css('color', 'blue');

			}


			if(('differences_tour' in data[j])) {

					$.each(data[j].differences_tour, function (key, value) {

						$('#'+value+'_'+j+'').css('color', 'blue');

					});

			}

			if(('new_tourists' in data[j])) {

				$.each(data[j].new_tourists, function (key, tourist_number) {

					tourist_number = tourist_number+1;

					// console.log('#container_tourist_and_documents_'+j+'_'+tourist_number+'');

					$('#container_tourist_and_documents_'+j+'_'+tourist_number+'').css('color', 'blue');

				});

			}

			if(('differences_tourists' in data[j])) {

				$.each(data[j].differences_tourists, function (tourist_number, tourist_indexes) {

					tourist_number = Number(tourist_number);

					tourist_number = tourist_number+1;
					// console.log(tourist_number);


					$.each(tourist_indexes, function (key, index) {

						// console.log('#'+index+'_'+j+'_'+tourist_number+'');
	
						$('#'+index+'_'+j+'_'+tourist_number+'').css('color', 'blue');

					})


				});

			}


			if(('differences_docs' in data[j])) {

				$.each(data[j].differences_docs, function (tourist_number, docs) {

					tourist_number = Number(tourist_number);

					tourist_number = tourist_number+1;
					// console.log(tourist_number);


					$.each(docs, function (doc_position, field_names) {

						doc_position = Number(doc_position+1);

						$.each(field_names, function (index, field_name) {

							console.log('#'+field_name+'_'+j+'_'+tourist_number+'_'+doc_position+'');

							$('#'+field_name+'_'+j+'_'+tourist_number+'_'+doc_position+'').css('color', 'blue');


						})
							

					})


				});

			}


			if(('new_documents' in data[j])) {

				$.each(data[j].new_documents, function (tourist_number, document_indexes) {

					tourist_number = Number(tourist_number);

					tourist_number = tourist_number+1;
					// console.log(tourist_number);


					$.each(document_indexes, function (key, index) {

						index = Number(index);
						
						doc_number = index + 1;


						// console.log('#'+index+'_'+j+'_'+tourist_number+'');
	
						$('#div_document_'+j+'_'+tourist_number+'_'+doc_number+'').css('color', 'blue');

					})


				});

			}





			if(('differences_buyer' in data[j])) {

				if(data[j].differences_buyer == 'different_buyer') {
					
					$('#div_buyer_'+j+'').css('color', 'blue');

				} else {

					$('#is_tourist_'+j+'').css('color', 'blue');


				}


			}




			if(('deleted_tourists' in data[j])) {

				$.each(data[j].deleted_tourists, function (index, previous_version_tourist_index) {


					tourist = data[j-1].tourists[previous_version_tourist_index];

					$('#version'+j+'').append(

					'<div class="container-fluid" id="tourist_deleted_'+index+'">'+

						'<h4>Турист '+previous_version_tourist_index+' из прошлой версии (удаленный):</h4>'+


						'<div class="row" id="tourist_deleted_row_'+index+'">'+

							'<div class="col-md-12">'+
							
								'<table class="table table-responsive table-bordered table-striped">'+

									'<tr>'+

									    '<th>Id</th>'+
									    '<th>Имя</th>'+
									    '<th>Фамилия</th>'+
									    '<th>Имя Англ.</th>'+
									    '<th>Фамилия Англ.</th>'+
									    '<th>День рож-я</th>'+
									    '<th>Гражданство</th>'+
									    '<th>Пол</th>'+
									    '<th>Телефон</th>'+
									    '<th>Email</th>'+

									'</tr>'+

									'<tr>'+

									    '<td>'+tourist.id+'</td>'+
									    '<td id="name_'+j+'_'+m+'">'+tourist.name+'</td>'+
									    '<td>'+tourist.lastName+'</td>'+
									    '<td>'+tourist.nameEng+'</td>'+
									    '<td>'+tourist.lastNameEng+'</td>'+    
									    '<td>'+tourist.birth_date+'</td>'+
									    '<td>'+tourist.citizenship+'</td>'+
									    '<td>'+tourist.gender+'</td>'+
									    '<td>'+tourist.phone+'</td>'+
									    '<td>'+tourist.email+'</td>'+


									'</tr>'+

								'</table>'+

							'</div>');


				var documents = tourist.docs;

				// console.log(documents);
				
				var number_of_documents  = 	Object.keys(documents).length;


					for (k = 0; k< number_of_documents; k++) {

						// var l = k+1;

						var document = documents[k];

							// $('#version'+j+'').append(

				$('#tourist_deleted_row_'+index+'').append(


								'<div class="col-md-6" id="document_deleted_'+index+'_'+k+'">'+

										'<table class="table table-responsive table-bordered table-striped">'+

											'<tr>'+

											    '<th class="col-md-4">Тип док-а 1</th>'+
											    '<th class="col-md-4">Номер док-а</th>'+
											    '<th class="col-md-2">Дата выдачи</th>'+
											    '<th class="col-md-2">Дата окон-я</th>'+

											'</tr>'+

											'<tr>'+

											    '<td>'+document.doc_type+'</td>'+
											    '<td>'+document.doc_number+'</td>'+
											    '<td>'+document.date_issue+'</td>'+
											    '<td>'+document.date_expire+'</td>'+
											
											'</tr>'+


										'</table>'+

								'</div>'


								);

					}


					if(data[j-1].buyer.is_buyer == previous_version_tourist_index) {

			$("#tourist_deleted_row_"+index+"").append(

				'<div class="row" id="div_buyer_'+j+'">'+

					'<div class="col-md-12">'+


						'<div class="col-md-6">'+

								'<table class="table table-responsive table-bordered table-striped">'+

									'<tr>'+

									    '<th class="col-md-4">Это заказчик?</th>'+
									    '<th class="col-md-4">Закачик едет в тур?</th>'+

									'</tr>'+

									'<tr>'+

									    '<td>Да</td>'+
									    '<td id="is_tourist_'+j+'">'+(data[j-1].buyer.is_tourist == 1 ? 'Да, едет' : 'Нет, не едет')+'</td>'+

									
									'</tr>'+


								'</table>'+

						'</div>'+

					'</div>'+

				'</div>');

				}







				});

			$('[id^="tourist_deleted_"]').find('*').css('text-decoration', 'line-through').css('text-decoration-color', 'black').css('color', 'red');


			} /// end If(deleted_tourists)



			if(('deleted_documents' in data[j])) {

					$.each(data[j].deleted_documents, function (this_tourist_number, contents) {

						this_tourist_number = Number(this_tourist_number);

						this_tourist_number = this_tourist_number+1;
						// console.log(tourist_number);

						previous_tourist_number = contents.previous_tourist_position;


						$.each(contents.previous_document_positions, function (key, previous_document_position) {

							previous_document_position = Number(previous_document_position);
							
							// previous_document_position = previous_document_position + 1;


							var document = data[j-1].tourists[previous_tourist_number].docs[previous_document_position];

							// console.log(documents);


							// $("#row_tourist_and_documents_"+j+"_"+this_tourist_number+"").append(

								$("#div_documents_"+j+"_"+this_tourist_number+"").append(

											'<div class="col-md-6" id="document_deleted_'+this_tourist_number+'_'+key+'">'+

													'<table class="table table-responsive table-bordered table-striped">'+

														'<tr>'+

														    '<th class="col-md-4">Тип док-а 1</th>'+
														    '<th class="col-md-4">Номер док-а</th>'+
														    '<th class="col-md-2">Дата выдачи</th>'+
														    '<th class="col-md-2">Дата окон-я</th>'+

														'</tr>'+

														'<tr>'+

														    '<td>'+document.doc_type+'</td>'+
														    '<td>'+document.doc_number+'</td>'+
														    '<td>'+document.date_issue+'</td>'+
														    '<td>'+document.date_expire+'</td>'+
														
														'</tr>'+


													'</table>'+

											'</div>'


											);

		


						})

					});

							$('[id^="document_deleted_"]').find('*').css('text-decoration', 'line-through')
							.css('text-decoration-color', 'black').css('color', 'red');



				}



				if('previous_buyer_not_in_deleted' in data[j]) {

					var tourist_number = data[j].previous_buyer_not_in_deleted;

					tourist_number = Number(tourist_number)+1;


					$("#row_tourist_and_documents_"+j+"_"+tourist_number+"").append(

						'<div class="row" id="div_buyer_deleted'+j+'">'+

							'<div class="col-md-12">'+


								'<div class="col-md-6">'+

										'<table class="table table-responsive table-bordered table-striped">'+

											'<tr>'+

											    '<th class="col-md-4">Это заказчик?</th>'+
											    '<th class="col-md-4">Закачик едет в тур?</th>'+

											'</tr>'+

											'<tr>'+

											    '<td>Да</td>'+
											    '<td id="is_tourist_'+j+'">'+(data[j-1].buyer.is_tourist == 1 ? 'Да, едет' : 'Нет, не едет')+'</td>'+

											
											'</tr>'+


										'</table>'+

								'</div>'+

							'</div>'+

						'</div>');


							$('[id^="div_buyer_deleted"]').find('*').css('text-decoration', 'line-through')
							.css('text-decoration-color', 'black').css('color', 'red');

				}





			} /// end Versions-iteration

					// Javascript to enable link to tab

					if (UURRLL.match('#')) {

					    $('.nav-tabs a[href="#' + UURRLL.split('#')[1] + '"]').tab('show');
					} 

					// Change hash for page-reload
					$('.nav-tabs a').on('shown.bs.tab', function (e) {
					    window.location.hash = e.target.hash;
					});


		})

		.fail( 
			function(data){


				alert("Ошибка в получении данных о версиях с сервера!");

			});




});
