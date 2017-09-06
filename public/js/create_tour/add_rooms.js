$(document).ready(function () {

	console.log("add_rooms.js loaded");

	$('#add_rooms').change(function(){

		var roomtext = $('#room').val();

		if($('#add_rooms').is(':checked')){

			$('#room').replaceWith('<textarea rows="5" placeholder="Тип номера" class="form-control" id="room" name="room">'+roomtext+'</textarea>');

		} else {

			$('#room').replaceWith('<input placeholder="Тип номера" class="form-control" id="room" name="room" value="'+roomtext+'" type="text">');
		}
	});
})