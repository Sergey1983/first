$(document).ready(function () {

	console.log("operator_full_pay.js loaded");

	$(document).on('focusout', 'input[name="date_depart"]', function () {


		var date_depart = $(this).val();

		console.log('date_depart', date_depart);

		var date_depart_mlsc = Date.parse(date_depart);

		console.log('date_depart_mlsc', date_depart_mlsc);

		var date_depart_Date = new Date(date_depart_mlsc);

		date_depart_Date = new Date(date_depart_Date.setHours(0));


		console.log('date_depart_Date', date_depart_Date);

		var now = new Date();

		var now = new Date(now.setHours(0,0,0));
		
		console.log('now', now);

		var diff_days =  Math.floor((Date.parse(date_depart) - Date.parse(now) ) / 86400000);

		console.log('diff_days', diff_days);

		var operator_full_pay = new Date();

		if(diff_days<0) {

			$('<p class="p-error">Дата не может быть раньше сегодня!</p>').appendTo($(this).closest('div')).fadeOut(3000);;

		} else if (diff_days < 7) {

			operator_full_pay.setDate(now.getDate() + 1);

			console.log('operator_full_pay', operator_full_pay);
		
		} else if (diff_days >=8 || diff_days <= 31 ) {

			operator_full_pay.setDate(now.getDate() + 3);

			console.log('operator_full_pay', operator_full_pay);

		} else {

			operator_full_pay.setDate(now.getDate() - 31);

			console.log('operator_full_pay', operator_full_pay);

		}





		// $('input[name="operator_full_pay"]').val(date_depart_Date.toISOString().substring(0, 10));


	});






})