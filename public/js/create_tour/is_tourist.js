$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("is_tourist.js loaded");

	$(document).on( "click", 'input[name="is_buyer"]', function() {

		$('div[class~="is_tourist"]').remove();

		$(this).after('<div class="is_tourist inline">'+

						  '<div class="is_tourist_radio">'+

							  '<label>Заказчик едет в тур?</label>'+

							  '<label>Да</label>'+
							  '<input type="radio" name="is_tourist" value="1">'+

							  '<label>Нет</label>'+
							  '<input type="radio" name="is_tourist" value="0">'+

							'</div>'+

					  '</div>'
					  );

	});

});