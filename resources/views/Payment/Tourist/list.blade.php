@extends('layouts.master')

@section('content')

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
				    <th>Метод оплаты</th>
			  	</tr>

			</thead>

			<tbody>

			    @foreach ($tourist_payments as $payment)
				<tr>
				    <td>{{ $payment->created_at }}</td>
				    <td><a href="/tours/{{ $payment->tour_id }}">{{ $payment->tour_id }}</a></td>
				    <td>{{ $payment->tour->buyer[0]->lastName }} {{substr($payment->tour->buyer[0]->name, 0, 2)}}.</td>
				    <td>{{ $payment->user->name }}</td>
				    <td>{{ $payment->tour->currency }}</td>
				    <td>{{ $payment->pay }}</td>
				    <td>{{ $payment->pay_rub }}</td>
				    <td>{{ $payment->pay_method->name }}</td>

			  	</tr>
	        
	 		   @endforeach

	 		 </tbody>

		</table>

	</div>

</div>

{{ $tourist_payments->links() }}



@endsection