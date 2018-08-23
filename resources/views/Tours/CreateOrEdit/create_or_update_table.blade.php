


<span id="id" hidden="">@isset($tour){{$tour->id}}@endisset</span>

		{!! 
			Form::macro('buttonSearch', function($value, $name, $type=null, $disabled=null) {

		    return "<button type=$type name='$name' class='btn btn-default btn-grey' $disabled>$value<span class='glyphicon glyphicon-search'></span></button>";
			});

		!!}


		{!! 
			Form::macro('buttonSearchPass', function($value, $name, $type=null, $disabled=null) {

		    return "<button type=$type name='$name' class='btn btn-default btn-grey col-md-8 col-md-offset-4' $disabled>$value<span> </span><span class='glyphicon glyphicon-search'></span></button>";
			});

		!!}

		{!! 
			Form::macro('selectNonDisabled', function($value, $placeholder, $array, $disabled=null, $class=null) {

				$select  = "<select class='form-control $class' $disabled name='$value'>";

				$select .= "<option selected='selected' hidden='hidden' value=''>$placeholder</option>";

				foreach ($array as $key => $value) {
						
				$select .= "<option value='$key'>$value</option>";

				}

				$select .= "</select>";

		    return $select;

			});

		 !!}




@include('Tours.CreateOrEdit.'.$tour_type.'_description')




<div class="container-fluid margin-top-25">

	<div class="row">

		<div class="col-md-12">

			<h4>Туристы:</h4>

		</div>

	</div>

	<div class="row">

		<div class="col-md-12 margin-bottom-10" id="submit_find_passengers">

			{!! Form::open(['id' => 'find_passengers', 'class' => 'form-inline'])!!}

			<div class="form-group">

				{!! Form::label('tour', '№ заявки:')!!}
				{!! Form::text('tour', null, ['class'=>'form-control']) !!}

			</div>

			<div class="form-group">

				{!! Form::buttonSearch('Вставить туристов из заявки', 'submit_find_passengers', 'button') !!}

			</div>

			{!! Form::close()!!}

		</div>

	</div>


	<div class="row">


		<div class="col-md-12">

			{!! Form::open(['id' => 'passengers_form', 'class'=>'form'] ) !!}



			{!! Form::hidden ('allchecked', 'false')!!}
			{!! Form::hidden('all_disabled', 'false') !!}
			{!! Form::hidden ('tour_exists')!!}
			{!! Form::hidden ('is_update', $is_update)!!}



			<div class="inputs_0 padding-all-10">

			<div class='row'>

					<div class='form-group col-md-3'>

						{!! Form::label('lastName[0]', 'Фамилия', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-8">

							{!! Form::text ('lastName[0]', null, ['placeholder' => 'Фамилия', 'class'=>'form-control'])!!}

						</div>

					</div>


					<div class='form-group col-md-3'>

						{!! Form::label('lastNameEng[0]', 'Фамил. анг.', ['class'=>'control-label col-md-4 no-padding-right'])!!}


						<div class="col-md-8">
							
							{!! Form::text ('lastNameEng[0]', null, ['placeholder' => 'Familiya', 'class'=>'form-control'])!!}

						</div>
						
					</div>


					<div class='form-group col-md-3 no-margin-bottom '>

						{!! Form::label('birth_date[0]', 'Дата рожд.', ['class'=>'control-label col-md-4'])!!}

						<div class="col-md-8">

							{!! Form::date ('birth_date[0]', null, ['placeholder' => 'Дата рождения', 'class'=>'form-control'])!!}
						
						</div>

					</div>

{{-- 					<div class='form-group col-md-3 no-margin-bottom no-padding-left'>

						<div class="col-md-6 no-padding-left padding-right-15">

						{!! Form::text ('phone[0]', null, ['placeholder' => 'Телефон', 'class'=>'form-control'])!!}

						
						</div>

					</div> --}}

					<div class='form-group col-md-3 no-margin-bottom'>

						{!! Form::label('phone[0]', 'Телефон', ['class'=>'control-label col-md-4'])!!}

						<div class="col-md-8">

							{!! Form::text ('phone[0]', null, ['placeholder' => 'Телефон', 'class'=>'form-control'])!!}
						
						</div>

					</div>


			</div>

			<div class="row">
				
					<div class='form-group col-md-3'>

						{!! Form::label('name[0]', 'Имя', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-8">
						
							{!! Form::text ('name[0]', null, ['placeholder' => 'Имя', 'class'=>'form-control'])!!}
						
						</div>

					</div>

					<div class='form-group col-md-3'>

						{!! Form::label('nameEng[0]', 'Имя анг.', ['class'=>'control-label col-md-4'])!!}

						<div class="col-md-8">

							{!! Form::text ('nameEng[0]', null, ['placeholder' => 'Imya', 'class'=>'form-control '])!!}

						</div>

					</div>


					<div class='form-group col-md-3'>

						{!! Form::label('gender[0]', 'Пол', ['class'=>'control-label col-md-4'])!!}

						<div class="col-md-8">

							{!! Form::selectNonDisabled ('gender[0]', 'Пол', $gender)!!}

						</div>

					</div>

{{-- 					<div class='form-group col-md-3 no-margin-bottom no-padding-left'>

						<div class="col-md-6 no-padding-left padding-right-15">

							{!! Form::text ('email[0]', null, ['placeholder' => 'Email', 'class'=>'form-control'])!!}

						
						</div>

					</div> --}}
					<div class='form-group col-md-3 no-margin-bottom '>

						{!! Form::label('email[0]', 'Email', ['class'=>'control-label col-md-4'])!!}

						<div class="col-md-8">

							{!! Form::text ('email[0]', null, ['placeholder' => 'Email', 'class'=>'form-control'])!!}
						
						</div>

					</div>

			</div>		


			<div class="row">
				
					<div class='form-group col-md-3'>

						{!! Form::label('patronymic[0]', 'Отчество', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-8">

							{!! Form::text ('patronymic[0]', null, ['placeholder' => 'Отчество', 'class'=>'form-control'])!!}

							<div class="row text-right padding-right-15">	
							
								<small>Отчество не нужно {!! Form::checkbox ('cancel_patronymic[0]', 1, null, ['id'=>'cancel_patronymic_0'])!!}</small>

							</div>			

						</div>

					</div>

					<div class='form-group col-md-3 col-md-offset-3'>
						
						{!! Form::label('citizenship[0]', 'Гражданство', ['class'=>'control-label col-md-4'])!!}

						<div class="col-md-8">

							{!! Form::select('citizenship[0]', ['Россия'=>'Россия'], null, ['class'=>"form-control", 'id'=>'citizenship[0]']) !!}

								<div class="row text-right padding-right-15">	
								
									<small>Другое {!! Form::checkbox ('change_citezenship', 1, null, ['id'=>'change_citezenship_0'])!!}</small>

								</div>					

						</div>

					</div>


			</div>			

{{-- 			<div class='row'>


				<div class='form-group col-md-3 no-margin-bottom '>

					{!! Form::label('birth_date[0]', 'Дата рождения', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

					{!! Form::date ('birth_date[0]', null, ['placeholder' => 'Дата рождения', 'class'=>'form-control'])!!}
					
					</div>

				</div>

				<div class='form-group col-md-3 no-margin-bottom'>

					{!! Form::label('citizenship[0]', 'Гражданство', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

					{!! Form::select('citizenship[0]', ['Россия'=>'Россия'], null, ['class'=>"form-control", 'id'=>'citizenship[0]']) !!}

						<div class="row text-right padding-right-15">	
						
							<small>Другое {!! Form::checkbox ('change_citezenship', 1, null, ['id'=>'change_citezenship_0'])!!}</small>

						</div>


					</div>



				</div>

				<div class='col-md-6'>

					<div class="form-group col-md-3 no-padding-left padding-right-15">

						{!! Form::selectNonDisabled ('gender[0]', 'Пол', $gender)!!}

					</div>


					<div class='form-group col-md-3'>
						
						{!! Form::text ('phone[0]', null, ['placeholder' => 'Телефон', 'class'=>'form-control'])!!}

					</div>


					<div class='form-group col-md-4'>


							{!! Form::text ('email[0]', null, ['placeholder' => 'Email', 'class'=>'form-control'])!!}

					</div>

				</div>




			</div> --}}


			<div class='row'>


				<div class='form-group col-md-3'>

					{!! Form::label('doc_type[0][0]', 'Документ-1', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

						{!! Form::selectNonDisabled ('doc_type[0][0]', 'Выберите док-т', $choose_doc, null, 'choose-doc')!!}

						</div>

				</div>

				<div class='form-group col-md-3' id='doc_0_div_0'>

					<div class="col-md-4 no-padding inline-block">
						
						{!! Form::text ('doc_seria[0][0]', null, ['placeholder' => 'Серия', 'class'=>'form-control d-block-inline first-doc', 'disabled'])!!}

					</div>

					<div class="col-md-8 no-padding inline-block padding-right-15">

						{!! Form::text ('doc_number[0][0]', null, ['placeholder' => 'Номер', 'class'=>'form-control d-block-inline first-doc', 'disabled'])!!}

					</div>


				</div>

				<div class="col-md-3" id="doc_0_div_dates_0">


					<div class="form-group col-md-6">

							{!! Form::date ('date_issue[0][0]', null, ['placeholder' => 'Дата выдачи', 'class'=>'form-control d-block-inline no-padding-right', 'id' => 'date_issue_1'])!!}
							<small>Дата выдачи</small>

					</div>

					<div class="form-group col-md-6">

							{!! Form::date ('date_expire[0][0]', null, ['placeholder' => 'Дата окончания', 'class'=>'form-control d-block-inline no-padding-right', 'id' => 'date_expire_1'])!!}
							<small>Дата окончания</small>
					
					</div>

				</div>




				<div class="form-group col-md-3 no-margin-bottom no-padding-left">

					<div class="col-md-12">

						{!! Form::buttonSearchPass('Найти по паспорту', 'check_doc_0', 'button') !!}

					</div>

					<div class="col-md-12 no-padding-left text-right">

						<small>Для поиска достаточно ввести только номер документа</small>
							
					</div>

				</div>





{{-- 				<div class='form-group col-md-3 no-margin-bottom no-padding-left'>

					<div class="col-md-6 no-padding-left col-md-offset-6">

						{!! Form::buttonSearch('Найти по паспорту', 'check_doc_0', 'button') !!}

					</div>

					<div class="col-md-12 no-padding-left text-right">

						<small>Для поиска достаточно ввести только номер документа</small>
							
					</div>

				</div> --}}



			</div>

			<div class='row' id ='row_second_doc_0'>


				<div class='form-group col-md-3'>

					{!! Form::label('doc_type[0][1]', 'Документ-2', ['class'=>'control-label col-md-4'])!!}

					<div class="col-md-8">

						{!! Form::selectNonDisabled ('doc_type[0][1]', 'Выберите док-т', $choose_doc, 'disabled', 'choose-doc')!!}

						<div class="row text-right padding-right-15">	
						
							<small>Нужен второй документ {!! Form::checkbox ('add_doc_2', 1, null, ['id'=>'add_doc_2_0'])!!}</small>

						</div>

					</div>


				</div>

				<div class='form-group col-md-3' id='doc_1_div_0'>

					<div class="col-md-4 no-padding inline-block">
						
						{!! Form::text ('doc_seria[0][1]', null, ['placeholder' => 'Серия', 'class'=>'form-control d-block-inline no-padding-right', 'disabled'=>'disabled'])!!}

					</div>

					<div class="col-md-8 no-padding inline-block padding-right-15">

							{!! Form::text ('doc_number[0][1]', null, ['placeholder' => 'Номер', 'class'=>'form-control d-block-inline no-padding-right', 'disabled'=>'disabled'])!!}

					</div>


				</div>



				<div class="col-md-3" id="doc_1_div_dates_0">


					<div class="form-group col-md-6" >


							{!! Form::date ('date_issue[0][1]', null, ['placeholder' => 'Дата выдачи', 'class'=>'form-control d-block-inline no-padding-right', 'disabled'=>'disabled', 'id' => 'date_issue_2'])!!}
							<small>Дата выдачи</small>

					</div>

					<div class="form-group col-md-6">

							{!! Form::date ('date_expire[0][1]', null, ['placeholder' => 'Дата окончания', 'class'=>'form-control d-block-inline  no-padding-right', 'disabled'=>'disabled', 'id' => 'date_expire_2'])!!}
							<small>Дата окончания</small>

					</div>

				</div>
{{-- 

				<div class='form-group col-md-3 no-margin-bottom no-padding-left'>

					<div class="col-md-6 no-padding-left padding-right-15">

							{!! Form::date ('date_expire[0][1]', null, ['placeholder' => 'Дата окончания', 'class'=>'form-control d-block-inline  no-padding-right', 'disabled'=>'disabled', 'id' => 'date_expire_2'])!!}
							<small>Дата окончания</small>
					
					</div>

				</div> --}}


			</div>


		

			<div class="row" id='payer'>

				<div class='form-group col-md-6'>
					

					{!! Form::label('Заказчик?', null, ['class'=>'col-md-2'])!!}



					<div class="col-md-1 text-left">

						{!! Form::radio ('is_buyer', 0)!!}

					</div>

				</div>


			</div>

			<div class="row" id='delete_tourist'>

				<div class='form-group col-md-6'>
					
					{!! Form::button('Удалить туриста', ['class' => 'inline btn btn-default delete_tourist']) !!}
		
				</div>


			</div>



			</div>

			</div>





			
			<div class='input'>
				
					{!! Form::button('+Еще турист', ['id' => 'add_tourist', 'class' => 'inline btn btn-default']) !!}
			</div>

			
			<div class='input submit'>

				<div class="row submit" >

					<div class="col-md-6" id="divsubmit">

					{!! Form::submit( $verb.=' тур', ['id' => $button, 'class' => 'inline btn btn-success']) !!}

					</div>

				</div>

			</div>

			{!! Form::close()!!}

		</div>

	</div>

</div>


{{-- 
<script type="text/javascript">



function randomselect(name) {

		var length = $('[name="'+name+'"]').find('option').length;
	    var value = Math.floor(Math.random() * (length - 2 + 1)) + 1;
	    value++;
	    $('[name="'+name+'"]').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');

};


function text(j) {
  var text = "";
  var possible = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя0123456789 ";


  for (var i = 0; i < j; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

$('select').each(function () {
	randomselect(this.name);
})

function randomtext(name, j) {
	$('[name*="'+name+'"]').val(text(j));
}



$('[type="text"]').each(function () {
	randomtext(this.name, 5);
})

$('textarea').each(function () {
	randomtext(this.name, 200);
})

$('[name="price"]').val('700');


setTimeout(country, 1000);
setTimeout(currency, 1000);
setTimeout(airport, 2000);



function currency(){
	    var value = Math.floor(Math.random() * (2 - 1 + 1)) + 1;
	    value++;
	    $('#currency').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');
	    $('input[id$="price_rub"]').val($('input[id$="price"]').val());
	    return false;
	};

function country(){
	    var value = Math.floor(Math.random() * (20 - 1 + 1)) + 1;
	    value++;
	    $('#country').find('option:nth-child(' + value + ')').prop('selected',true).trigger('change');
	    return false;
	};

function airport() {
	setTimeout($('#airport').find('option:nth-child(' + 3 + ')').prop('selected',true).trigger('change'), 2000);

}


</script> --}}


