$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("add_passenger.js loaded");


	$('#add_passenger').on('click', function (event) {

		event.preventDefault();

		var i = $("div[class*='inputs_']").length;

		$new_passenger = $(

			'<div class="inputs_'+i+' padding">'+

			'<br><br>'+
				'<label>Имя: </label>'+
				'<input type="text" name="name['+i+']" placeholder="Имя">'+

			'<br><br>'+
			'<label>Фамилия: </label>'+
			'<input type="text" name="lastName['+i+']" placeholder="Фамилия">'+

			'<br><br>'+
			'<label>Дата рождения: </label>'+
			'<input type="date" name="birth_date['+i+']" value="" placeholder="Дата рождения">'+

			'<br><br>'+
			'<label>Doc number: </label>'+ 
			'<input type="text" name="doc_fullnumber['+i+']" placeholder="Doc number">'+
			'<button type="button" class="check_doc"> Проверить? </button>'+

			'<br><br>'+
			'<label>Заказчик?: </label>'+ 
			'<input type="radio" name="is_buyer" value="'+i+'">'+

			'<br><br>'+
			'<button type="button" class="delete_passenger"> Удалить туриста? </button>'+

			'</div>'

			);

		$('.inputs_'+(i-1)+'').after($new_passenger);
				
		i+=1;


	});

});