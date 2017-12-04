$(document).ready(function () {

	console.log("change_citizenship.js loaded");

	$(document).on('change', 'input[id*="change_citezenship_"]', function(){


		var number = $(this).attr('id').replace('change_citezenship_', '');


		if(this.checked){

			$('select[id="citizenship['+number+']"]').replaceWith('<input placeholder="Введите гражданство" class="form-control" id="citizenship['+number+']" name="citizenship['+number+']" type="text">');

		} else {

			$('input[id="citizenship['+number+']"]').replaceWith('<select class="form-control" id="citizenship['+number+']" name="citizenship['+number+']"><option value="Россия">Россия</option></select>');
		}

	});
	
})