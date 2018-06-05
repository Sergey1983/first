$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("visa_add_people.js loaded");


	$('#visa').change(function () {

		if( $('#visa option:selected').val() != 'Нет' )

		{

			$('#visa_add_people_div').remove();

			$('#visa_div').append(

			'<div class="row" id="visa_add_people_div">'+

				'<div class="col-md-12 text-right">'+

					'<small>Виза нужна не всем туристам? <input id="visa_add_people" name="visa_add_people" type="checkbox" value="1"></small>'+

				'</div>'+

			'</div>');

		} else {

			$('#visa_add_people_div').remove();


		}

	});


	$(document).on('change', '#visa_add_people', function(){

		if(this.checked)

		{
	
			$('#visa_form_group').after(
				'<div class="form-group" id="visa_people_form_group">'+

				'<div class="col-md-8 col-md-offset-4">'+

				'<textarea rows="4" placeholder="Введите имена туристов, которым нужна услуга" class="form-control" id="visa_people" name="visa_people"></textarea>'+

				'</div>'+

				'</div>')
		}

		else 

		{

			$('#visa_people_form_group').remove();
		}

	});



});


