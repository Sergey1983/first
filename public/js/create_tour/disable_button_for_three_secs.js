

				
function disable_button_for_three_secs (button) {
				var btn = button;

			    btn.prop('disabled', true);

			    setTimeout(function(){

			        btn.prop('disabled', false);

			    }, 3000);

}