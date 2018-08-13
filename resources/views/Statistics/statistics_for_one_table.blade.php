<div class="col-md-12">

		<table class='table table-striped table-hover table-responsive no-margin-bottom'>
			
			<thead>
				<tr>
				    <th>id</th>
				    <th>Создана</th>
				    <th>Вылет</th>
				    <th>Туристов</th>
				    <th>Стоим. для туристов</th>
				    <th>Стоимость оператора</th>
				    <th>Долг оператору</th>
				    <th>План. прибыль</th>
				    <th>Факт. прибыль</th>
				    <th>Коммиссия</th>

			  	</tr>
			</thead>

	<tbody id="tbody_stats">

		@php $number_of_tours = 0; @endphp

		@foreach($results as $key => $line) 

			@if(!in_array($key, ['totals', 'request'], true))

				<tr>

				    <td><a href="/tours/{{$line['id']}}">{{$line['id']}}</a></td>
				    <td>{{$line['created_at']}}</td>
				    <td>{{$line['date_depart']}}</td>
				    <td>{{$line['number_of_tourists']}}</td>
				    <td>{{$line['tourist_price']}}</td>
				    <td>{{$line['operator_price']}}</td>
				    <td>{{$line['debt_to_operator']}}</td>
				    <td>{{$line['planned_profit']}}</td>
				    <td>{{$line['real_profit']}}</td>
				    <td>{{$line['commission']}}</td>
				</tr>

				@php $number_of_tours += 1; @endphp

			@endif



		@endforeach

				<tr>
				    <td><strong>{{$number_of_tours}}</td>
				    <td>{{'-'}}</td>
				    <td>{{'-'}}</td>
				    <td><strong>{{$results['totals']['number_of_tourists']}}</td>
				    <td><strong>{{$results['totals']['tourist_price']}}</td>
				    <td><strong>{{$results['totals']['operator_price']}}</td>
				    <td><strong>{{$results['totals']['debt_to_operator']}}</td>
				    <td><strong>{{$results['totals']['planned_profit']}}</td>
				    <td><strong>{{$results['totals']['real_profit']}}</td>
				    <td><strong>{{$results['totals']['commission']}}</td>
				</tr>

	</tbody>

</table>