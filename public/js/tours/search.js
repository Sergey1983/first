$(document).ready(function(){



	$('#search_button').on('click', function () {

		var parameters = $('#serach').serialize();

		$.ajax({
			type: 'post',
			url: '/tours_2',
			data: parameters, 
		})

		.done(
			function (data) {
				


			}

		)

	})



})