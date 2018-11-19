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

		var edit = false;

		var compare_to;

		if($('#tour_created_at').length > 0) {

			var edit = true;

			compare_to = new Date($('#tour_created_at').html());

			compare_to = new Date(compare_to.setHours(0,0,0));

			console.log('comparte_to', compare_to);

		} else {

			var now = new Date();

			var now = new Date(now.setHours(0,0,0));

			compare_to = now;
			
			console.log('now', now);

		}

		var diff_days =  Math.floor((Date.parse(date_depart) - Date.parse(compare_to) ) / 86400000);

		console.log('diff_days', diff_days);

		// var operator_full_pay = new Date();

		if(diff_days<0) {

			$('<p class="p-error">Дата не может быть раньше ' + compare_to.toLocaleDateString('ru-RU')  + '!</p>').appendTo($(this).closest('div')).fadeOut(3000);;

		} else if (!edit) { 



				if (diff_days < 7) {

					operator_full_pay = new Date(now);

					console.log('operator_full_pay', operator_full_pay);
				
				} else if (diff_days >=8 && diff_days < 31 ) {

					console.log('now.getDate()', now.getDate() );

					var operator_full_pay = new Date(now.setDate(now.getDate() + 2));

					console.log('operator_full_pay', operator_full_pay);

				} else {

					console.log('date_depart_Date', date_depart_Date);

					var operator_full_pay = new Date(date_depart_Date.setDate(date_depart_Date.getDate() - 31));

					console.log('operator_full_pay', operator_full_pay);

				}

						function formatDate(date) {
						    var d = new Date(date),
						        month = '' + (d.getMonth() + 1),
						        day = '' + d.getDate(),
						        year = d.getFullYear();

						    if (month.length < 2) month = '0' + month;
						    if (day.length < 2) day = '0' + day;

						    return [year, month, day].join('-');
						}




				$('input[name="operator_full_pay"]').val(formatDate(operator_full_pay));

			}

	});






})