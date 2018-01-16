$(document).ready(function () {
	
	console.log('load_tour.js loaded');

	serch_form_fullfill(1);

	load_table('/load_tours_function');


	$('#search_button').on('click', function (event){

		event.preventDefault();

		serch_form_fullfill();

		load_table('/load_tours_function');


	});


	$(document).on('click', '[href*="load_tours_function"]', function (event) {

		event.preventDefault();


		// var fulllink = $(this).attr('href');	

		// var link = fulllink.substr(fulllink.lastIndexOf('/') + 1);

		var link = $(this).attr('href');
		
		load_table(link);


	});



	$('#date_depart, #created_at').on('click', function (){

		$('.sort').attr('active', 'not');
		$(this).attr('active', 'active');
		$('.sort').not(this).attr('next_sort', 'asc');
		$(this).attr('next_sort')  == 'asc' ? $(this).attr('next_sort', 'desc') : $(this).attr('next_sort', 'asc');
		load_table('/load_tours_function');


	});


	function load_table(link=null) {

			var searchdata = $('#search').serialize();

			// console.log(searchdata);


			$('.sort').each(function(){

				if ($(this).attr('active') == 'active') {

					var sort_name = this.id;
					var sort_value = $(this).attr('next_sort');
					searchdata = searchdata + '&sort_name=' + sort_name + '&sort_value=' + sort_value;

				}

			});

			console.log(link);

			$.ajax({
					type: 'GET',
					url: link,
					data: searchdata,
			})

			.done(function (data) {
				
				console.log(data);

				var prev_url = data.prev_page_url == null ? null : getAndDecrementLastNumber(data.prev_page_url);
				var next_url = data.next_page_url == null ? null : getAndIncrementLastNumber(data.next_page_url, data.last_page);



				$('[aria-label="Previous"]').attr('href', prev_url);
				$('[aria-label="Next"]').attr('href', next_url);


				// var thead = $('#load_tours_table_thead');
				var tbody = $('#tbody_tours');

				tbody.empty();

				$('pagination[class="pagination"]').find('li').not(':first').not(':last').remove();

				var from = data.current_page;

				var to = data.current_page+20 < data.last_page ? data.current_page+20 : data.last_page;				

				for (var i = from; i <= to; i++) {

					$('[aria-label="Next"]').parent().before('<li '+(data.current_page == i ? 'class="page-item active"' : 'class="page-item"')+'"><a class="page-link" id ="paginator'+i+'" href="../load_tours_function?page='+i+'">'+i+'</a></li>');

				}

				$(data.data).each(function (key, tour) {


					$("#tbody_tours").append(
						'<tr>'+
								'<td>'+tour.id+'</td>'+
								'<td>'+tour.created_at.replace(/\s.*/, '')+'</td>'+
								'<td>'+tour.status+'</td>'+
								'<td>'+tour.operator_code+'</td>'+
								'<td>'+tour.user_name+'</td>'+
								'<td>'+tour.buyer+'</td>'+
								'<td>'+tour.number_of_tourists+'</td>'+
								'<td>'+tour.country+'</td>'+
								'<td>'+(tour.tour_type == 'Пакетный' ? '<span data-toggle="tooltip" data-placement="top" title="'+tour.product_tooltip+'">'+tour.product+'</span>' : tour.tour_type)+'</td>'+
								'<td>'+tour.date_depart+'</td>'+
								'<td>'+tour.nights+'</td>'+
								'<td>'+tour.price+'</td>'+
								'<td>'+tour.price_rub+'</td>'+
								'<td>'+tour.comission+'</td>'+
								'<td class="text-center">'+tour.debt+'</td>'+
								'<td>'+tour.operator_price+'</td>'+
								'<td>'+tour.operator_price_rub+'</td>'+
								'<td><a class="btn btn-sm btn-info" href="/tours/'+tour.id+'">Подробнее</a></td>'+
						'</tr>'


						);


				})

			

			})
			.fail( function () {
				
				$("#tbody_tours").append('<tr><th>Произошла ошибка!</th></tr>');

			});


	}


	function serch_form_fullfill(iteration=null) {
		
		var actuality = $("input[name='actuality_f']:checked").val();

		// console.log(actuality);
		var created_from = $("input[name='created_from_f']").val();
		var created_to = $("input[name='created_to_f']").val();
		var ids_from = $("input[name='ids_from_f']").val();
		var ids_to = $("input[name='ids_to_f']").val();
		var depart_from = $("input[name='depart_from_f']").val();
		var depart_to = $("input[name='depart_to_f']").val();
		var country = $("select[name='country_f']").val();
		var operator = $("select[name='operator_f']").val();
		var hotel = $("input[name='hotel_f']").val();
		var manager = $("select[name='manager_f']").val();
		var product = $("select[name='product_f']").val();
		var paginate = $("select[name='paginate_f']").val();
		var tourist_name = $("input[name='tourist_name_f']").val();
		var tourist_lastname = $("input[name='tourist_lastname_f']").val();
		var branch = $("select[name='branch_f']").val();


		if(iteration == null) {

			$('#search').find('[selected="selected"]').removeAttr('selected');
			$('#search').find('input').removeAttr('value');

		}



		// $("select[name='actuality'] option[value='"+actuality+"']").attr('selected', 'selected');
		$("input[name='actuality']").attr('value', actuality);
		$("input[name='created_from']").attr('value', created_from);
		$("input[name='created_to']").attr('value', created_to);
		$("input[name='ids_from']").attr('value', ids_from);
		$("input[name='ids_to']").attr('value', ids_to);		
		$("input[name='depart_from']").attr('value', depart_from);
		$("input[name='depart_to']").attr('value', depart_to);
 		// $("select[name='country'] option[value='"+country+"']").attr('selected', 'selected');
		$("input[name='country']").attr('value', country);
 		// $("select[name='operator'] option[value='"+operator+"']").attr('selected', 'selected');
		$("input[name='operator']").attr('value', operator);
		$("input[name='hotel']").attr('value', hotel);
 		// $("select[name='manager'] option[value='"+manager+"']").attr('selected', 'selected');
		$("input[name='manager']").attr('value', manager);
		$("input[name='product']").attr('value', product);
 		// $("select[name='paginate'] option[value='"+paginate+"']").attr('selected', 'selected');
		$("input[name='paginate']").attr('value', paginate);
		$("input[name='tourist_name']").attr('value', tourist_name);
		$("input[name='tourist_lastname']").attr('value', tourist_lastname);
		$("input[name='branch']").attr('value', branch);


	}

	function getAndIncrementLastNumber(str, lastpage) {


		var link_num = str.match(/\d+$/)[0];


		if (Number(link_num)+20 > lastpage) {

			return null;

		} else {

		    return str.replace(/\d+$/, function(s) {

		        return +s+20;
		   
		    });

		}


	}

	function getAndDecrementLastNumber(str) {


		var link_num = str.match(/\d+$/)[0];


		if (Number(link_num)-20 < 0) {

			return 1;

		} else {

		    return str.replace(/\d+$/, function(s) {

		        return +s-20;
		   
		    });

		}


	}




})