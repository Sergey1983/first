@extends('layouts.master')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/various/alert_fadeout.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/payment_tourist/pay_fullfil.js ') }}"></script>



@php

	$currency = strtoupper($tour->currency);

	$url = $request->create == true ? '/tours/'.$tour->id.'/pay_tourist?&create=true' : '/tours/'.$tour->id.'/pay_tourist';

@endphp


		<div class="col-md-6 margin-top-25">


 			{!!Form::open(['url' => $url, 'id' => 'payment_tourist', 'class' =>'form-horizontal']) !!}


					 	<div class="form-group">


							{!! Form::label(null, 'Стоимость тура в '.$currency.'', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

								<div class="well well-sm" style="margin-bottom:0px;" id="price">{{$tour->price}}</div>

						 	</div>

						</div>

					 	<div class="form-group">


							{!! Form::label(null, 'Турист должен '.$currency.'', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

								<div class="well well-sm" style="margin-bottom:0px;">{{number_format($tour->price - $tour->payments_from_tourists_sum(), 2, '.', '')}}</div>

						 	</div>

						</div>

@unless($tour->currency == 'RUB')

					 	<div class="form-group">


							{!! Form::label(null, 'Стоимость тура в RUB', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

								<div class="well well-sm" style="margin-bottom:0px;" id="price_rub">{{$tour->price_rub}}</div>

						 	</div>

						</div>

					 	<div class="form-group">


							{!! Form::label(null, 'Турист должен в RUB', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

								<div class="well well-sm" style="margin-bottom:0px;">{{$tour->price_rub - $tour->payments_from_tourists_rub_sum()}}</div>

						 	</div>

						</div>


@endunless


@unless($tour->currency == 'RUB')

					 	<div class="form-group" id="payment_tourist_rub">


							{!! Form::label('pay', 'Сумма в '.$currency.'', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

						 		{!! Form::text('pay', null, ['placeholder' =>  'Введите сумму в '.$currency.'' , 'class'=>"form-control", 'id'=>'pay', 'required'] )  !!}

						 	</div>

						</div>

@endunless



@php

$create_and_credit = $tour->is_credit == 1 && $request->create == true;

$first_payment = $create_and_credit ? $tour->first_payment : null;

$pay_methods = $create_and_credit ? [3 => "Кредит"] : $pay_methods;

$pay_method = $create_and_credit ? 3 : null;

$readonly =  $create_and_credit ? 'readonly' : null;


@endphp


					 	<div class="form-group" id="pay_rub">


							{!! Form::label('pay_rub', 'Сумма в рублях', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

{{-- 								@if($tour->is_credit == 1 && $request->create == true) 
 --}}
						 		{!! Form::text('pay_rub', $first_payment, ['placeholder' =>  'Введите сумму в рублях', 'class'=>"form-control", 'id'=>'pay_rub', 'required', $readonly] )  !!}
{{-- 
						 		@else

						 		{!! Form::text('pay_rub', null, ['placeholder' =>  'Введите сумму в рублях', 'class'=>"form-control", 'id'=>'pay_rub', 'required'] )  !!}

						 		@endif --}}

						 	</div>

						</div>


					 	<div class="form-group" id="pay_method_id">


							{!! Form::label('pay_method_id', 'Метод оплаты', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-4">

						 		{!! Form::select('pay_method_id', $pay_methods, $pay_method, ['class'=>"form-control", 'id'=>'pay_method_id', 'required', $readonly] )  !!}

						 	</div>

						</div>



		@unless($tour->price==$tour->payments_from_tourists_sum())

						<div class="form-group text-center">

							{!! Form::submit('Добавить платеж', ["class"=>'btn btn-success']) !!}

						</div>

						@if($errors->any())

				            @foreach ($errors->all() as $error)

 								<div class="alert alert-warning text-center">

					                {{ $error }}

								</div>

							@endforeach

						@endif



						
		@endunless




			{!!Form::close()!!}
		
		</div>

</div>

<div class="container-fluid">





</div>


@unless($tour->payments_from_tourists()->onlyTrashed()->get()->isEmpty())

		@php

			if (session('with_deleted')!=null) {
				
				$a['route'] = 'payment_tourist.create';
				$a['submit_value'] = 'Не показывать удаленные';
				$a['method'] = 'get';

				}

			else {

				$a['route'] = 'payment_tourist.create.with_deleted';
				$a['submit_value'] = 'Показать удаленные';
				$a['method'] = 'post';

			}

		@endphp

<div class="container-fluid">

	<div class="col-md-8">


		<div class="row text-right"> 

			{!!Form::open([ 'route'=>[$a['route'], $tour->id], 'method'=>$a['method'] ])!!}	

					{!!Form::submit($a['submit_value'], ['class'=>'btn btn-sm btn-default'])!!}

			{!!Form::close()!!}
		
		</div>

	</div>

</div>

@endunless




@unless($tour->payments_from_tourists()->withTrashed()->get()->isEmpty())

<div class="container-fluid">

	<div class="col-md-8">


	<div class="row"> 


		<table class="table table-inverse">

			<thead>

				<tr>
					<th>Платеж №</th>
					<th>Сумма в {{strtoupper($tour->currency)}}</th>
						@unless($tour->currency == 'RUB')
							<th>Сумма в RUB</th>
						@endunless
					<th>Менеджер</th>
					<th>Время добавление</th>
					<th>Метод оплаты</th>
					<th></th>

				</tr>

			</thead>


		

		@php 


			$payments_from_tourists = session('with_deleted') == 'true' ? $tour->payments_from_tourists()->withTrashed()->get() : $tour->payments_from_tourists;

		@endphp

		@foreach ($payments_from_tourists as $key => $payment) 
			<tbody>

				<tr>
					<td>{{$key+1}}</td>
					<td>{{$payment->pay}}</td>
						@unless($tour->currency == 'RUB')
							<td>{{$payment->pay_rub}}</td>
						@endunless
					<td>{{$payment->user->name}}</td>
					<td>{{$payment->created_at}}</td>
					<td>{{$payment->pay_method->name}}</td>

					<td>

					@if(!$payment->trashed())

					{!!Form::open(['route'=>['payment_tourist.delete', $tour->id, $payment->id]])!!}	

							{!!Form::submit('Удалить', ['class'=>'btn btn-sm btn-warning'])!!}

					{!!Form::close()!!}

					@else 

					Платеж удален {{$payment->deleted_at}} кем: {{$payment->user_deleted->name}}

					@endif

					</td>
				</tr>

			</tbody>

		@endforeach

		</table>
		
	</div>

	</div>

</div>



@endunless

@endsection