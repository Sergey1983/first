
	<div class="col-md-12">

		<table class='table table-striped table-hover table-responsive no-margin-bottom'>
			
			<thead>
				<tr >
				    <th>№</th>
				    <th class="sort" id="created_at" active="not" next_sort="desc">Создана</th>
				    <th>C</th>
				    <th>№ брони</th>
				    <th>Оператор</th>
				    <th>Менеджер</th>
				    <th>Заказчик</th>
				    <th>Чел.</th>
				    <th>Страна:</th>
				    <th>Продукт:</th>
				    <th class="sort" id="date_depart" active="not" next_sort="desc">Вылет</th>
				    <th>Ноч.</th>
				    <th colspan="2">Стоимость</th>
				    <th>%</th>
				    <th style="word-break: break-word">Долг клиента </th>
				    <th colspan="2">К оплате</th>
				    <th></th>
			  	</tr>
			</thead>
{{-- 			@foreach ($tours as $tour)
--}}		

	<tbody id="tbody_tours">
{{-- 				
				<tr>

					<td>{{ $tour->id }}</td>
					<td>{{ date("Y-m-d", strtotime($tour->created_at)) }}</td>
					<td>{{ $tour->operator_code }}</td>
					<td>{{ $tour->user->name }}</td>
					<td>{{ $tour->city_from }}</td>
					<td>{{ $tour->date_depart }}</td>
					<td>{{ $tour->nights }}</td>
					<td>{{ number_format($tour->price_rub, 2, ',', ' ') }}</td>
					<td><a class="btn btn-sm btn-info" href="/tours_2/{{$tour->id}}">
					Подробнее
					</a></td>

				</tr>

 --}}

			</tbody>

{{-- 			@endforeach
--}}
		</table>

		<nav aria-label="Page navigation example">

		  <pagination class="pagination" >

		    <li class="page-item">

		      <a class="page-link" href="#" aria-label="Previous">

		        <span aria-hidden="true">&laquo;</span>

		        <span class="sr-only">Previous</span>

		      </a>

		    </li>
{{-- 
		    <li class="page-item">

		      <a class="page-link" href="#" aria-label="Previous">

		        <span aria-hidden="true">&lt;</span>

		        <span class="sr-only">Previous</span>

		      </a>

		    </li> --}}

{{-- 		    <li class="page-item">

		      <a class="page-link" href="#" aria-label="Next">

		        <span aria-hidden="true">&gt;</span>

		        <span class="sr-only">Previous</span>

		      </a>

		    </li> --}}


		    <li class="page-item">

		      <a class="page-link" href="#" aria-label="Next">

		        <span aria-hidden="true">&raquo;</span>

		        <span class="sr-only">Next</span>

		      </a>

		    </li>

		  </pagination>

		</nav>


	</div>

</div>