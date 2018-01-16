$(document).ready(function(){



	$('#search_button').on('click', function () {

		var parameters = $('#serach').serialize();

		$.ajax({
			type: 'post',
			url: '/tours',
			data: parameters, 
		})

		.done(
			function (data) {
				


			}

		)

	})



})