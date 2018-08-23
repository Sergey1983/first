$(document).ready(function () {

	console.log("pay_fullfill.js loaded");

	if(window.location.href.includes('&create=true') && $('input[name="pay"]').length != 0) {

			var conversion_rate = $("#price_rub").html() / $("#price").html();


		if($('input[name="pay_rub"]').val().length != 0 ) {

			$('input[name="pay"]').val($('input[name="pay_rub"]').val()/conversion_rate);

		}

		$(document).on('focusout', 'input[name="pay_rub"]', function() {

			$('input[name="pay"]').val($('input[name="pay_rub"]').val()/conversion_rate);

		});

}




})




