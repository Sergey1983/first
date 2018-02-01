@extends('layouts.master')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/various/alert_fadeout.js') }}"></script>

{{-- <div class="container-fluid text-center margin-bottom-10">
	
	<h3>Внести оплату оператору</h3>

</div> --}}

<div class="container-fluid margin-top-25">


		<div class="row">

			{!!Form::open(['id' => 'payment_operator', 'class' =>'form-horizontal'])!!}

			<div class="col-md-5">
				

					 	<div class="form-group">


							{!! Form::label(null, 'Всего оплатить оператору RUB', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-6">

								<div class="well well-sm" style="margin-bottom:0px;">{{$tour->operator_price_rub}}</div>

						 	</div>

						</div>

					 	<div class="form-group">


								{!! Form::label(null, 'Осталось оплатить оператору RUB', ['class'=>'control-label  col-md-4'])!!}

								<div class="col-md-6">

									<div class="well well-sm" style="margin-bottom:0px;">{{$tour->operator_price_rub - $tour->payments_to_operator_rub_sum()}}</div>

							 	</div>

							</div>

	


@unless($tour->currency == 'RUB')		


					 	<div class="form-group">


							{!! Form::label(null, 'Всего оплатить оператору '.strtoupper($tour->currency).'', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-6">

								<div class="well well-sm" style="margin-bottom:0px;">{{$tour->operator_price}}</div>

						 	</div>

						</div>

					 	<div class="form-group">


							{!! Form::label(null, 'Осталось оплатить оператору '.strtoupper($tour->currency).'', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-6">

								<div class="well well-sm" style="margin-bottom:0px;">{{$tour->operator_price - $tour->payments_to_operator_sum()}}</div>

						 	</div>

						</div>


@endunless



					 	<div class="form-group">


							{!! Form::label('pay_rub', 'Сумма в рублях', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-6">

						 		{!! Form::text('pay_rub', null, ['placeholder' =>  'Введите сумму в рублях' , 'class'=>"form-control", 'id'=>'pay_rub', 'required'] )  !!}

						 	</div>

						</div>

@unless($tour->currency == 'RUB')	

					 	<div class="form-group">


							{!! Form::label('pay', 'Сумма в '.strtoupper($tour->currency).'', ['class'=>'control-label  col-md-4'])!!}

							<div class="col-md-6">

						 		{!! Form::text('pay', null, ['placeholder' =>  'Введите сумму в '.strtoupper($tour->currency).'' , 'class'=>"form-control", 'id'=>'pay', 'required'] )  !!}

						 	</div>

						</div>

@endunless


		@unless($tour->operator_price_rub==$tour->payments_to_operator_rub_sum())

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


@unless($tour->payments_to_operator()->onlyTrashed()->get()->isEmpty())

		@php

			if (session('with_deleted')!=null) {
				
				$a['route'] = 'payment_operator.create';
				$a['submit_value'] = 'Не показывать удаленные';
				$a['method'] = 'get';

				}

			else {

				$a['route'] = 'payment_operator.create.with_deleted';
				$a['submit_value'] = 'Показать удаленные';
				$a['method'] = 'post';

			}

		@endphp

<div class="container-fluid">

	<div class="col-md-7">

		<div class="row text-right"> 

			{!!Form::open([ 'route'=>[$a['route'], $tour->id], 'method'=>$a['method'] ])!!}	

					{!!Form::submit($a['submit_value'], ['class'=>'btn btn-sm btn-default'])!!}

			{!!Form::close()!!}
		
		</div>

	</div>

</div>

@endunless




@unless($tour->payments_to_operator()->withTrashed()->get()->isEmpty())

<div class="container-fluid">

	<div class="col-md-7">



	<div class="row"> 


		<table class="table table-stripped">

			<thead>

				<tr>
					<th>Платеж №</th>
				@unless($tour->currency=='RUB')
					<th>Сумма в {{$tour->currency}}
				@endunless					
					<th>Сумма в РУБ</th>
					<th>Менеджер</th>
					<th>Время добавление</th>
					<th></th>

				</tr>

			</thead>
		

		@php 


			$payments_to_operator = session('with_deleted') == 'true' ? $tour->payments_to_operator()->withTrashed()->get() : $tour->payments_to_operator;

		@endphp

		@foreach ($payments_to_operator as $key => $payment) 
			<tbody>

				<tr>
					<td>{{$key+1}}</td>
				@unless($tour->currency=='RUB')
					<td>{{$payment->pay}}</td>
				@endunless
					<td>{{$payment->pay_rub}}</td>
					<td>{{$payment->user->name}}</td>
					<td>{{$payment->created_at}}</td>
					<td>

					@if(!$payment->trashed())

					{!!Form::open(['route'=>['payment_operator.delete', $tour->id, $payment->id]])!!}	

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

