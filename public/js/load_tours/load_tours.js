$(document).ready(function () {
	
	console.log('load_tour.js loaded');


	$.ajax({
			type: 'POST',
			url: '/load_tours_function',
	})

	.done(function (data) {
		
		console.log(data);

		// var thead = $('#load_tours_table_thead');
		var tbody = $('#load_tours_table_tbody');


		for (var i = 0; i < data.length; i++) {

			var id = data[i]['id'];
			var city_from = data[i]['сity_from'];
			var hotel = data[i]['hotel'];

			tbody.append('<tr id="'+i+'">'+
				'<td>'+id+'</td>'+
				'<td>'+city_from+'</td>'+
				'<td>'+hotel+'</td>'+
				'<td><a href="/tours_2/'+id+'"><button>Подробнее</button></a></td>'+
				'</tr>');
		}

	

	})
	.fail( function () {
		
		tbody.append('<tr><th>Произошла ошибка!</th></tr>');

	});

})