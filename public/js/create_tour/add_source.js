$(document).ready(function () {

	console.log("add_source.js loaded");

	$('#add_source').change(function(){

		if($('#add_source').is(':checked')){

			$('#source').replaceWith('<input placeholder="Введите источник заявки" class="form-control" id="source" name="source" type="text">');

		} else {

			$('#source').replaceWith('<select class="form-control" id="source" name="source"><option selected="selected" disabled="disabled" hidden="hidden" value="">Выберите источник заявки</option><option selected="selected" disabled="disabled" hidden="hidden" value="">Выберите источник заявки</option><option value="Онлайн-консультант">Онлайн-консультант</option><option value="Онлайн-бронирование">Онлайн-бронирование</option><option value="Заявка на поиск тура">Заявка на поиск тура</option><option value="Пришел в офис">Пришел в офис</option><option value="Постоянный клиент">Постоянный клиент</option><option value="Cоцсети">Соцсети</option></select>');
		}

	});
	
})