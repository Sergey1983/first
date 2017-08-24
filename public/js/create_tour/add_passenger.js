$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("add_passenger.js loaded");


	$('#add_passenger').on('click', function (event) {

		event.preventDefault();

		var i = $("div[class*='inputs_']").length;

		$new_passenger = $(

			'<div class="inputs_'+i+' padding">'+

				'<div class="form-group">'+

					'<label class="control-label col-md-1">Имя: </label>'+
						
					'<div class="col-md-3">'+
					
							'<input type="text" class="form-control" name="name['+i+']" placeholder="Имя">'+
					
					'</div>'+

				'</div>'+


				
				'<div class="form-group">'+
	
					'<label class="control-label col-md-1">Фамилия: </label>'+
					
					'<div class="col-md-3">'+
					
						'<input type="text" class="form-control" name="lastName['+i+']" placeholder="Фамилия">'+
					
					'</div>'+

				'</div>'+



				'<div class="form-group">'+
	
					'<label class="control-label col-md-1">Дата рождения: </label>'+
					
					'<div class="col-md-3">'+
					
						'<input type="date" class="form-control" name="birth_date['+i+']" value="" placeholder="Дата рождения">'+
					
					'</div>'+

				'</div>'+



				'<div class="form-group">'+

					'<label class="control-label col-md-1" for="doc_fullnumber['+i+']">Номер паспорта</label>'+ 
					
					'<div class="col-md-3">'+
					
						'<input type="text" class="form-control" name="doc_fullnumber['+i+']" placeholder="Номер паспорта">'+
					
					'</div>'+

					'<button id="check_doc" class="btn btn-default">Проверить <span class="glyphicon glyphicon-search"></span></button>'+

				'</div>'+



				'<div class="form-group" id="payer">'+
	
					'<label class="control-label col-md-1">Заказчик?: </label>'+ 
					
					'<div class="col-md-3">'+
					
						'<input type="radio" name="is_buyer" value="'+i+'">'+
					
					'</div>'+

				'</div>'+


				
				'<div class="form-group">'+
					
					'<div class="col-md-3">'+
					
						'<button type="button" class="delete_passenger btn btn-default"> Удалить туриста? </button>'+
					
					'</div>'+

				'</div>'+



			'</div>'




			);

		$('.inputs_'+(i-1)+'').after($new_passenger);
				
		i+=1;


	});

});