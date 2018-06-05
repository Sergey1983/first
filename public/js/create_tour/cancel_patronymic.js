$(document).ready(function () {

	console.log("cancel_patronymic.js loaded");

	$(document).on('change', 'input[name^="cancel_patronymic"]', function() {

		var index = $('input[name^="cancel_patronymic"]').index(this);

		if($(this).is(':checked')){

			$('input[name^="patronymic['+index+']"]').attr('readonly', 'readonly').val('');


		} else {

			$('input[name^="patronymic['+index+']"]').removeAttr('readonly').val('').attr('placeholder', 'Отчество');

		}
	});
})