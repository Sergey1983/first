$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("airport_load.js loaded");


	$(document).on('change', '#country', function  () {
		
		var country_val = $(this).val();

		$.ajax ({
			
			type: 'POST',
			url: '/airport_load',
			data: {country : country_val},

		})

		.done(function (data) {

				$('#airport').find('option').remove();
				$('#airport').append('<option selected="selected" disabled="disabled" hidden="hidden" value="">Выберите аэропорт</option>');


				$.each(data,function(key, value) 
				{
				    $('#airport').append('<option value=' + key + '>' + value + '</option>');
				});

		})

		.fail(function () {

					$('<div class="form-group">'+
					 	'<span class="col-md-1"></span>'+
						'<div class="alert alert-warning col-md-4">'+
  							'Ошибка, свяжитесь с техническим администратором.'+ 
						'</div>'+
					   '</div>'
					).insertAfter($('#country').closest('.form-group'));

		})


	});






});
