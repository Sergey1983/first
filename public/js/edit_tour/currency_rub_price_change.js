$(document).ready(function () {

	console.log("currency_rub_price_change.js loaded");

	$(document).on('focusout', 'input[name="price_rub"]', function () {

		console.log($('select[name="currency"]').val());

		if( $('select[name="currency"]').val() === 'RUB' ) {


			var price_rub = $('input[name="price_rub"]').val();

			$('input[name="price"]').val(price_rub);

		}



	});






})