<div class="container-fluid margin-top-25">

	<div class="row">

		<div class="col-md-12">

{{-- 			<h1>Список туров</h1>
 --}}

			{!! Form::open(['id' => 'search', 'class'=>'form'] ) !!}

					<div class='form-group col-md-3'>
						{!! Form::label('actuality', 'Актуальность', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-8">
							{!! Form::select ('actuality', ['Да'=>'Да', 'Нет' => 'Нет', 'Любые'=> 'Любые'], 'Да', ['class'=>"form-control"])!!}
						</div>

					</div>


					<div class="row submit" >

						<div class="col-md-6" id="divsubmit">

						{!! Form::submit( 'Применить', ['id'=>'search_button', 'class' => 'inline btn btn-success']) !!}

						</div>

					</div>



			{!! Form::close()!!}

		</div>

	</div>

	<div class="row">

		<div class="col-md-12">
	
			<table class='table table-striped table-hover table-responsive'>
				
				<thead>
					<tr >
					    <th>Id заявки</th>
					    <th>Создана</th>
					    <th>Код-туроператора</th>
					    <th>Менеджер</th>
					    <th>Вылет из:</th>
					    <th>Дата вылета</th>
					    <th>Ночей</th>
					    <th>Стоимость</th>
					    <th></th>
				  	</tr>
				</thead>
{{-- 			@foreach ($tours as $tour)
 --}}			<tbody id="tbody_tours">
				
{{-- 					<tr>

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

				</tbody> --}}

{{-- 			@endforeach
 --}}
			</table>

			<nav aria-label="Page navigation example">

			  <ul class="pagination">

			    <li class="page-item">

			      <a class="page-link" href="#" aria-label="Previous">

			        <span aria-hidden="true">&laquo;</span>

			        <span class="sr-only">Previous</span>

			      </a>

			    </li>




			    <li class="page-item">

			      <a class="page-link" href="#" aria-label="Next">

			        <span aria-hidden="true">&raquo;</span>

			        <span class="sr-only">Next</span>

			      </a>

			    </li>

			  </ul>

			</nav>




{{-- {{$tours->links()}}
 --}}		</div>

	</div>

</div>

{{-- 	<h1>Список туров 2</h1>

		<table id ='load_tours_table'>
		
			<thead id='load_tours_table_thead'>
			
				<tr>
				    <th id='id'>Id заявки</th>
				    <th id='city_from'>Вылет из:</th>
				    <th id='hotel'>Отель</th>
				    <th></th>
			  	</tr>

			</thead>

			<tbody id='load_tours_table_tbody'>


		  	</tbody>

		</table>
 --}}

