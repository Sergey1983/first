$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE


	console.log("delete_passengers.js loaded");

	// test_number = 2;

	// for (var i = 0; i < test_number; i++) {
	// $('#add_tourist').trigger('click');


	// }


	// for (var i = 0; i < $("div[class*='inputs_']").length; i++) {



	//  	for (var j = 0; j < $("div[class*='inputs_']:eq("+i+")").children('input').length; j++ )
	//  		  $( $("div[class*='inputs_']:eq("+i+")").children('input')[j]).val(i);

	// }


	$(document).on('click', '.delete_tourist', function (event) {

			event.preventDefault();
			
			var div_to_delete  = $(this).parents('[class^="inputs_"]');

			var number = Number($(this).parents('[class^="inputs_"]').attr('class').replace('inputs_', '').replace(' padding', ''));


			if(number == 0) {

				alert("Нельзя удалить единственного туриста!");

				return;
			}

			var next_divs = div_to_delete.nextAll("div[class*='inputs_']");

			div_to_delete.remove();



			$.each(next_divs, function(index, div) {

				$(div).prop('class', 'inputs_'+number+' padding');


				$(div).find('select[id^="citizenship_"]').prop('id', 'citizenship_'+number+'');

				$(div).find('input[name="change_citezenship"]').prop('id', 'change_citezenship_'+number+'');

				$(div).find('button[id^="transliterate_"]').prop('id', 'transliterate_'+number+'');

				$(div).find('button[name^="check_doc_"]').prop('name', 'check_doc_'+number+'');

				$(div).find('div[id^="row_second_doc_"]').prop('id', 'row_second_doc_'+number+'');

				$(div).find('input[name="is_buyer"]').prop('value', number);

				$(div).find('input[name="add_doc_2"]').prop('id', 'add_doc_2_'+number+'');

				$(div).find('div[id^="doc_1_div_"]').prop('id', 'doc_1_div_'+number+'');





				$.each($(div).find('input'), function(index, input) {

					var name = input.name;

					var id = input.id;

					if(name.match(/[a-zA-Z_]+\[/g) !== null) {
						

						newname = name.replace(/\d+/, number);

						newid = id.replace(/\d+/, number);

						$(input).prop('name', newname);

						$(input).prop('id', newid);

					}

				});


				$.each($(div).find('select'), function(index, select) {

					var name = select.name;

					if(name.match(/[a-zA-Z_]+\[/g) !== null) {
						
						newname = name.replace(/\d+/, number);

						$(select).prop('name', newname);

					}

				});


				$.each($(div).find('label'), function(index, label) {


					var varfor = $(label).attr('for');


					if(varfor.match(/[a-zA-Z_]+\[/g) !== null) {

						newfor = varfor.replace(/\d+/, number);

						$(label).prop('for', newfor);

					}

				});


				number = number + 1;
			})






			var parent_div = $(this).parent();


			// /// CHECK IF IT'S NOT THE FIRST PASSENGER (WE DON'T DELETE FIRST PASSENGER)
			// if( !(parent_div.is($("div[class*='inputs_']:first"))) ) {


			// 	var this_and_next_divs = parent_div.add(parent_div.nextAll("div[class*='inputs_']"));

			// 	var child_inputs = this_and_next_divs.children('input');
				

			// 	for (var i = 0; i < this_and_next_divs.length; i++) {

			// 		this_inputs = $(this_and_next_divs[i]).children('input');
					
			// 		next_inputs = $(this_and_next_divs[i+1]).children('input');


					
			// 		for (var j = 0; j < this_inputs.length ; j++) {


			// 			$( this_inputs[j] ).val( $( next_inputs[j] ).val() );


			// 		}


			// 	}

			// 	$("div[class*='inputs_']:last").remove();

			// }
			
	})



});