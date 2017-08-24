$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("is_tourist.js loaded");

	$(document).on( "click", 'input[name="is_buyer"]', function() {

		$('div[class~="is_tourist"]').remove();

		$(this).closest('#payer').after('<div class="form-group is_tourist">'+
	
							'<label class="control-label col-md-1">Заказчик едет в тур?</label>'+
							
							'<div class="col-md-3">'+

								'<label class="radio-inline"><input type="radio" name="is_tourist" value="1">Да</label>'+
								'<label class="radio-inline"><input type="radio" name="is_tourist" value="0">Нет</label>'+
							
							'</div>'+

						'</div>'
					  );

	});

});