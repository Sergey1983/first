$(document).ready(function () {

	console.log("add_credit.js loaded");

	$('select[name="is_credit"]').change(function(){


		if(this.value == 1) {

			$('div[id$="is_credit"]').after(

						 	'<div class="form-group" id="first_payment">'+

								'<label for="first_payment" class="control-label col-md-4">Первый взнос</label>'+

								'<div class="col-md-8">'+

							 		'<input placeholder="Введите первый взнос" class="form-control" id="first_payment" name="first_payment" type="text">'+

							 	'</div>'+

							'</div>'+

						 	'<div class="form-group" id="bank">'+
								
								'<label for="bank" class="control-label col-md-4">Первый взнос</label>'+

								'<div class="col-md-8">'+

									'<select class="form-control" id="bank" name="bank">'+
									'<option selected="selected" disabled="disabled" hidden="hidden" value="">Выберите банк</option>'+
									'<option value="ООО Хоум кредит энд финанс банк">ООО Хоум кредит энд финанс банк</option>'+
									'<option value="ООО КБ Ренессанс кредит">ООО КБ Ренессанс кредит</option>'+
									'<option value="ПАО Почта банк">ПАО Почта банк</option>'+
									'</select>'+

							 	'</div>'+

							'</div>'


				);
			
		} else {

			$('div[id$="first_payment"]').remove();

			$('div[id$="bank"]').remove();

		}


	});
})