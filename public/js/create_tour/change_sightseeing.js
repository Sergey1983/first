
$(document).ready(function () {

	console.log("change_sightseeing.js loaded");

	$('#change_sightseeing').change(function(){
		if($('#change_sightseeing').is(':checked')){
			$('#sightseeing').removeAttr('readonly').val('').attr('placeholder', 'Введите экскурсию');

		} else {

			$('#sightseeing').attr('readonly', 'readonly').val('Нет');
		}
	});
})