
$(document).ready(function () {

	console.log("add_food_type.js loaded");

	$('#add_food_type').change(function(){

		if($('#add_food_type').is(':checked')){

			$('#food_type').replaceWith('<input placeholder="Введите тип питания" class="form-control" id="food_type" name="food_type" type="text">');

		} else {

			$('#food_type').replaceWith('<select class="form-control" id="food_type" name="food_type"><option selected="selected" disabled="disabled" hidden="hidden" value="">Тип питания</option><option value="RO">RO</option><option value="BB">BB</option><option value="HB">HB</option><option value="FB">FB</option><option value="AI">AI</option></select>');
		}

	});
	
})