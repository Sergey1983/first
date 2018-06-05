$(document).ready(function () {

	console.log("add_price_rub.js loaded");

	$(document).on('change', '#currency', function(){

		if($('#currency').val() != 'RUB'){

			$('input[id$="price"]').removeAttr('readonly');
			$('input[id$="price"]').attr('placeholder', 'Введите стоимость в валюте');


		} else {

			$('input[id$="price"]').attr('readonly', 'readonly').val('');
			$('input[id$="price"]').removeAttr('placeholder');

		}
	});
})