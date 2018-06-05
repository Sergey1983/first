$(document).ready(function() {
	
	console.log('edit_tour_load_param.js loaded');

	// Get Tour id
	
	// id = get_tour_id();
	id = $("#id").text()

	// Get tour params:

		$.ajax({
			type: 'post',
			url: '/edit_tour_prepare_data',
			data: {0: id}, 
		})

		.done(
			function(data) {

				fill_all_fields(data);
	

		 }



		 )

		.fail(function() { 
			alert('Произошла ошибка!');
		})

});
