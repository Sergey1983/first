@extends('layouts.master')

@section('content')

{{-- <div class="container-fluid text-center margin-bottom-10">
	
	<h3>Подтверждение бронирования</h3>

</div>
 --}}
<div class="container-fluid margin-top-25">

		<div class="col-md-5">
	
			{!!Form::open(['id' => 'booking', 'class' =>'form-horizontal'])!!}

					 	<div class="form-group" id="operator_code">


							{!! Form::label('operator_code', 'Код бронирования', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::text('operator_code', $tour->operator_code, ['placeholder' =>  'Введите код заявки', 'class'=>"form-control", 'id'=>'operator_code', 'required'] )  !!}

						 	</div>

						</div>

@unless($tour->currency=='RUB')

					 	<div class="form-group">


							{!! Form::label('operator_price', 'Сумма к оплате оператору в '.strtoupper($tour->currency).'', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::text('operator_price', $tour->operator_price, ['placeholder' =>  'Введите сумму в '.strtoupper($tour->currency).'', 'class'=>"form-control", 'id'=>'operator_price'] )  !!}

						 	</div>

							<div class="col-md-offset-4 padding-left-15">

								<small>Стоимость в валюте в заявке: {{$tour->price}} {{$tour->currency}}</small>

						 	</div>

						</div>

@endunless

					 	<div class="form-group">


							{!! Form::label('operator_price_rub', 'Сумма к оплате оператору в RUB', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

						 		{!! Form::text('operator_price_rub', $tour->operator_price_rub, ['placeholder' =>  'Введите сумму в RUB', 'class'=>"form-control", 'id'=>'operator_price_rub'] )  !!}

						 	</div>

							<div class="col-md-offset-4 padding-left-15">

								<small>Стоимость в рублях в заявке: {{$tour->price_rub}} РУБ.</small>

						 	</div>

						</div>


					 	<div class="form-group">
							
								{!! Form::label('operator_full_pay', 'Срок полной оплаты', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

								{!! Form::date ('operator_full_pay', $tour->operator_full_pay, ['class'=>'form-control', 'id'=>'operator_full_pay'])!!}

						 	</div>

						</div>

					 	<div class="form-group">
							
								{!! Form::label('operator_part_pay', 'Срок частичной оплаты', ['class'=>'control-label col-md-4'])!!}

							<div class="col-md-8">

								{!! Form::date ('operator_part_pay', $tour->operator_part_pay, ['class'=>'form-control', 'id'=>'operator_part_pay'])!!}

						 	</div>

						</div>


					 	<div class="form-group" id="status">


							{!! Form::label('status', 'Статус бронирования', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-8">

							{!! Form::select ('status', ['Бронирование'=>'Бронирование', 'Подтверждено'=>'Подтверждено', 'Отказ'=>'Отказ', 'Аннулировано'=>'Аннулировано'], $tour->status , ['placeholder' =>  'Выберите статус', 'class'=>"form-control", 'required'])!!}

						 	</div>

						</div>




						<div class="form-group padding-left-15">

							{!! Form::submit(is_null($tour->operator_code)?'Сохранить!':'Изменить!', ["class"=>'btn btn-primary col-md-offset-4']) !!}


						</div>

			{!!Form::close()!!}
		
		</div>

</div>


@endsection