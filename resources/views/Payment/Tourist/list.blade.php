@extends('layouts.master')

@section('content')



<div class="container-fluid margin-top-25">
	

			{!! Form::open(['method'=> "get", 'route' => ['tourist_payments.index']]) !!}


		<div class="col-md-2">

			{!! Form::date ('date_from', null, ['class'=>'form-control', 'id'=>'date_from', 'required'])!!}
			
		</div>

		<div class="col-md-2">

			{!! Form::date ('date_to', null, ['class'=>'form-control', 'id'=>'date_to', 'required'])!!}
			
		</div>

		<div class="col-md-2 no-padding-right">

			{!!Form::submit('Показать по датам', ['class' => 'btn btn-default'])!!}
	
			
		</div>

			{!! Form::close() !!}


</div>


<div class="container-fluid margin-top-25 ">

	<div class="col-md-12">

		<table class="table table-responsive table-bordered table-striped col-md-12">
		
			<thead>
			
				<tr>
				    <th>Внесена</th>
				    <th>Заявка</th>
				    <th>Заказчик</th>
				    <th>Менеджер</th>
				    <th>Валюта</th>
				    <th>Cумма</th>
				    <th>Сумма в рублях</th>
				    <th>Курс</th>
				    <th>Метод оплаты</th>
			  	</tr>

			</thead>

			<tbody>

			    @foreach ($tourist_payments as $payment)
				<tr>
				    <td>{{ $payment->created_at }}</td>
				    <td><a href="/tours/{{ $payment->tour_id }}">{{ $payment->tour_id }}</a></td>
				    <td>{{ $payment->tour->buyer[0]->lastName }} {{substr($payment->tour->buyer[0]->name, 0, 2)}}. {{substr($payment->tour->buyer[0]->patronymic, 0, 2)}}.</td>
				    <td>{{ $payment->user->name }}</td>
				    <td>{{ $payment->tour->currency }}</td>
				    <td>{{ $payment->pay }}</td>
				    <td>{{ $payment->pay_rub }}</td>
				    <td>{{ $payment->pay ? number_format($payment->pay_rub / $payment->pay, 2, ',', ' ') : '-' }}</td>
				    <td>{{ $payment->pay_method->name }}</td>

			  	</tr>
	        
	 		   @endforeach

	 		 </tbody>

		</table>

	</div>

{{ $tourist_payments->links() }}

</div>




@endsection