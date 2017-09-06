$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE

	console.log("noexit_insurance_add_people.js loaded");


	$('#noexit_insurance').change(function () {

		if( $('#noexit_insurance option:selected').val() != 'Нет' )

		{

			$('#noexit_insurance_add_people_div').remove();

			$('#noexit_insurance_div').append(

			'<div class="row" id="noexit_insurance_add_people_div">'+

				'<div class="col-md-12 text-right">'+

					'<small>Виза нужна не всем туристам? <input id="noexit_insurance_add_people" name="noexit_insurance_add_people" type="checkbox" value="1"></small>'+

				'</div>'+

			'</div>');

		} else {

			$('#noexit_insurance_add_people_div').remove();


		}

	});


	$(document).on('change', '#noexit_insurance_add_people', function(){

		if(this.checked)

		{
	
			$('#noexit_insurance_form_group').after(
				'<div class="form-group" id="noexit_insurance_people_form_group">'+

				'<div class="col-md-8 col-md-offset-4">'+

				'<textarea rows="4" placeholder="Введите имена туристов, которым нужна услуга" class="form-control" id="noexit_insurance_people" name="noexit_insurance_people"></textarea>'+

				'</div>'+

				'</div>')
		}

		else 

		{

			$('#noexit_insurance_people_form_group').remove();
		}

	});



});


