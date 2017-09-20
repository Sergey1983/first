$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("is_tourist.js loaded");

	$(document).on( "click", 'input[name="is_buyer"]', function() {

		$('#is_tourist').remove();

		$(this).closest('#payer').after(

						'<div class="row" id="is_tourist">'+

							'<div class="form-group col-md-6">'+
		
								'<label class="control-label col-md-2">Заказчик едет в тур?</label>'+
								
								'<div class="col-md-1">'+

									'<label class="radio-inline"><input type="radio" name="is_tourist" id="is_tourist_1" value="1">Да</label>'+
								
								'</div>'+

								'<div class="col-md-1">'+			

									'<label class="radio-inline"><input type="radio" name="is_tourist" id="is_tourist_0" value="0">Нет</label>'+
								
								'</div>'+

							'</div>'+

						'</div>'




					  );

	});

});