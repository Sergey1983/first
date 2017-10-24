$(document).ready(function () {
	
	console.log('load_tour.js loaded');


	load_table('/load_tours_function');



	function load_table(link) {


			$.ajax({
					type: 'GET',
					url: link,
			})

			.done(function (data) {
				
				console.log(data);


				$('[aria-label="Previous"]').attr('href', data.prev_page_url);
				$('[aria-label="Next"]').attr('href', data.next_page_url);


				// var thead = $('#load_tours_table_thead');
				var tbody = $('#tbody_tours');

				tbody.empty();

				$('ul[class="pagination"]').find('li').not(':first').not(':last').remove();

				for (var i = 1; i <= data.last_page; i++) {

					$('[aria-label="Next"]').parent().before('<li class='+(data.current_page == i ? "page-item active" : "page-item")+'"><a class="page-link" href="load_tours_function?page='+i+'">'+i+'</a></li>');

				}

				$(data.data).each(function (key, tour) {
					
					$("#tbody_tours").append(
						'<tr>'+
								'<td>'+tour.id+'</td>'+
								'<td>'+tour.created_at+'</td>'+
								'<td>'+tour.operator_code+'</td>'+
								'<td>'+tour.user_name+'</td>'+
								'<td>'+tour.city_from+'</td>'+
								'<td>'+tour.date_depart+'</td>'+
								'<td>'+tour.nights+'</td>'+
								'<td>'+tour.price_rub+'</td>'+
								'<td><a class="btn btn-sm btn-info" href="/tours_2/'+tour.id+'">Подробнее</a></td>'+
						'</tr>'


						);


				})

			

			})
			.fail( function () {
				
				tbody.append('<tr><th>Произошла ошибка!</th></tr>');

			});


	}



	$(document).on('click', '[href*="load_tours_function"]', function (event) {


		event.preventDefault();

		var fulllink = $(this).attr('href');	

		var link = fulllink.substr(fulllink.lastIndexOf('/') + 1);

		load_table(link);


	});



})