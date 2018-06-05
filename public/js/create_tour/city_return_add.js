$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("city_return_add.js loaded");

	$('#city_return_add').change(function () {

		if($('#city_return_add').is(':checked'))

		{

			$('#city_return_form_group').remove();

			var city_from_options = $('[name="city_from"] > option').clone();

			$('#city_from_form_group').after(

			'<div class="form-group" id="city_return_form_group">'+

				'<label for="city_return" class="control-label col-md-4">Город возвращения</label>'+
					
					'<div class="col-md-8">'+

						 '<select class="form-control" id="city_return" name="city_return"></select>'+
								
					'</div>'+

			'</div>');

			$('#city_return').append(city_from_options);

		} else {

			$('#city_return_form_group').remove();

		}

	});



});


