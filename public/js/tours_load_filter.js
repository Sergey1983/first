$(document).ready(function () {
			

	  		load_tours();		



			// Filter Tours

			$('#filter').click(function (event) {

						event.preventDefault();

						load_tours();

						});


			// UnFilter Tours

			$('#filter-reset').click(function() {

						$('#search-form').trigger("reset");

						load_tours();

						});


			function load_tours () {

						$.ajax({

							type: 'get',
							url: 'load_tours',
							data: $('#search-form').serialize(),
							})
							.done(function (data) {

								$('#tours_table').empty();

								tableCreate(data);



							});			
							

			};

			function tableCreate (data) {

				$.each( data, function (i, item) {

			    var tr = $('<tr>').append(
			    	$('<td>').text(item.id),
			    	$('<td>').text(item.name),
			    	$('<td>').text(item.lastName),
			    	$('<td>').text(item.nameEng),
			    	$('<td>').text(item.lastNameEng),
			    	$('<td>').text(item.destination),									
			    	$('<td>').text(item.departure),
			    	$('<td>').html('<a href="/tours/'+item.id+'"><button >'+'Редактировать'+'</button></a>'));
			     $('#tours_table').append(tr);


				});

				$('th').off('click');

				$.getScript('/js/sort_paginate.js');
			};


			

			
});

