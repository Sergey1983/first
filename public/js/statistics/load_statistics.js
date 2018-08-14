
$(document).ready(function () {
	
	console.log('load_statistics.js loaded');


	search_form_fullfill(1);

	load_table('/load_statistics');


	$('#search_button').on('click', function (event){

		event.preventDefault();

		search_form_fullfill();

	console.log('search', $('#search').serialize());


		load_table('/load_statistics');


	});






	$('.sort').on('click', function (){

		$('.sort').attr('active', 'not');
		$(this).attr('active', 'active');
		$('.sort').not(this).attr('next_sort', 'asc');
		$(this).attr('next_sort')  == 'asc' ? $(this).attr('next_sort', 'desc') : $(this).attr('next_sort', 'asc');
		load_table('/load_statistics');


	});





	function load_table(link=null, key=null) {

			var searchdata = $('#search').serialize();

			console.log(searchdata);

			$('.sort').each(function(){

				if ($(this).attr('active') == 'active') {

					var sort_name = this.id;
					var sort_value = $(this).attr('next_sort');
					searchdata = searchdata + '&sort_name=' + sort_name + '&sort_value=' + sort_value;

				}

			});

			console.log(searchdata);

			console.log(link);

			var ajax = $.ajax({
					type: 'GET',
					url: link,
					data: searchdata,
			})

			.done(function (data) {
				
				console.log(data);

				var tbody = $('#tbody_stats');

				tbody.empty();

				$.each(data, function (key, i) {

				if(key != 'totals') {

					var row = 	'<tr>'+
									'<td class = "key" id="'+key+'"><a href="load_statistics_for_one?'+searchdata + '&key=' + key +'">'+key+'</a></td>'+
									'<td>'+i.number_of_tourists+'</td>'+
									'<td>'+i.number_of_tours+'</td>'+
									'<td>'+i.total_tourist_price+'</td>'+
									'<td>'+i.paid_to_operator+'</td>'+
									'<td>'+i.debt_to_operator+'</td>'+
									'<td>'+i.planned_profit+'</td>'+
									'<td>'+i.real_profit+'</td>'+
									'<td>'+i.total_commission+'</td>'+
									'<td>'+i.arpu+'</td>'+
									'<td>'+i.check+'</td>'+
								'</tr>';

					} else {

					var row = 	'<tr>'+
									'<td><strong>Всего</td>'+
									'<td><strong>'+i.number_of_tourists+'</td>'+
									'<td><strong>'+i.number_of_tours+'</td>'+
									'<td><strong>'+i.total_tourist_price+'</td>'+
									'<td><strong>'+i.paid_to_operator+'</td>'+
									'<td><strong>'+i.debt_to_operator+'</td>'+
									'<td><strong>'+i.planned_profit+'</td>'+
									'<td><strong>'+i.real_profit+'</td>'+
									'<td><strong>'+i.total_commission+'</td>'+
									'<td><strong>'+i.arpu+'</td>'+
									'<td><strong>'+i.check+'</td>'+
								'</tr>';


					}

					$("#tbody_stats").append(row);


				});



			})
			.fail( function () {
				
				$("#tbody_stats").append('<tr><th>Произошла ошибка!</th></tr>');

			});



	}


	function search_form_fullfill(iteration=null) {
		
		var actuality = $("input[name='actuality_f']:checked").val();
		var created_from = $("input[name='created_from_f']").val();
		var created_to = $("input[name='created_to_f']").val();
		var ids_from = $("input[name='ids_from_f']").val();
		var ids_to = $("input[name='ids_to_f']").val();
		var depart_from = $("input[name='depart_from_f']").val();
		var depart_to = $("input[name='depart_to_f']").val();
		var report_type	= $("select[name='report_type_f']").val();





		$("input[name='actuality']").val(actuality);
		$("input[name='created_from']").val(created_from);
		$("input[name='created_to']").val(created_to);
		$("input[name='ids_from']").val(ids_from);
		$("input[name='ids_to']").val(ids_to);		
		$("input[name='depart_from']").val(depart_from);
		$("input[name='depart_to']").val(depart_to);
		$("input[name='report_type']").val(report_type);



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

			return str.replace(/\d+$/, 1);

		} else {

		    return str.replace(/\d+$/, function(s) {

		        return +s-20;
		   
		    });

		}


	}


	var toMmDdYy = function(input) {
	    var ptrn = /(\d{4})\-(\d{2})\-(\d{2})/;
	    if(!input || !input.match(ptrn)) {
	        return null;
	    }
	    return input.replace(ptrn, '$3-$2-$1');
	};






});




