$(document).ready(function () {

	console.log("pay_fullfill.js loaded");

	if(window.location.href.includes('&create=true') && $('input[name="pay"]').length != 0) {


		if($('input[name="pay_rub"]').val().length != 0 ) {

			$('input[name="pay"]').val(in_currency());

		}

		$(document).on('focusout', 'input[name="pay_rub"]', function() {

			$('input[name="pay"]').val(in_currency());

		});

}




})


function in_currency(){

   var conversion_rate = $("#price_rub").html() / $("#price").html();

   var in_currency = $('input[name="pay_rub"]').val()/conversion_rate;

   return in_currency = in_currency.toFixed(2);

}



