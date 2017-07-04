$(document).ready(function() {
	
	// ADDING A PASSENGER FOR CREATE TOUR TABLE


	console.log("delete_passengers.js loaded");

	// test_number = 2;

	// for (var i = 0; i < test_number; i++) {
	// $('#add_passenger').trigger('click');


	// }


	// for (var i = 0; i < $("div[class*='inputs_']").length; i++) {



	//  	for (var j = 0; j < $("div[class*='inputs_']:eq("+i+")").children('input').length; j++ )
	//  		  $( $("div[class*='inputs_']:eq("+i+")").children('input')[j]).val(i);

	// }


	$(document).on('click', '.delete_passenger', function (event) {

			event.preventDefault();
			
			var parent_div = $(this).parent();


			/// CHECK IF IT'S NOT THE FIRST PASSENGER (WE DON'T DELETE FIRST PASSENGER)
			if( !(parent_div.is($("div[class*='inputs_']:first"))) ) {


				var this_and_next_divs = parent_div.add(parent_div.nextAll("div[class*='inputs_']"));

				var child_inputs = this_and_next_divs.children('input');
				

				for (var i = 0; i < this_and_next_divs.length; i++) {

					this_inputs = $(this_and_next_divs[i]).children('input');
					
					next_inputs = $(this_and_next_divs[i+1]).children('input');


					
					for (var j = 0; j < this_inputs.length ; j++) {


						$( this_inputs[j] ).val( $( next_inputs[j] ).val() );


					}


				}

				$("div[class*='inputs_']:last").remove();

			}
			
	})



});