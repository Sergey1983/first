<div class="container-fluid margin-top-25">

	<div class="row">

		<div class="col-md-12">

{{-- 			<h1>Список туров</h1>
 --}}

			{!! Form::open(['id' => 'search', 'class'=>'form'] ) !!}

				<div class="row">

					<div class='form-group col-md-2'>

						{!! Form::label('actuality', 'Актуальность', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('actuality', ['Да'=>'Да', 'Нет' => 'Нет', 'Любые'=> 'Любые'], 'Любые', ['class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-4'>
						{!! Form::label('created', 'Дата создания', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-4 no-padding">
							
							{!! Form::date ('created_from',\Carbon\Carbon::createFromDate(1980, 12, 25), ['class'=>'form-control'])!!}
						</div>

						<div class="col-md-4 no-padding">
							
							{!! Form::date ('created_to', \Carbon\Carbon::now(), ['class'=>'form-control'])!!}
						</div>

					</div>

					<div class='form-group col-md-4'>
						{!! Form::label('created', 'Дата вылета', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-4 no-padding">
							
							{!! Form::date ('depart_from', null {{-- \Carbon\Carbon::createFromDate(2005, 12, 25) --}}, ['class'=>'form-control'])!!}
						</div>

						<div class="col-md-4 no-padding">
							
							{!! Form::date ('depart_to', null {{-- \Carbon\Carbon::now() --}}, ['class'=>'form-control'])!!}
						</div>

					</div>

				</div>	

				<div class="row">

					<div class='form-group col-md-2'>

						{!! Form::label('country', 'Страна', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('country', $countries, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>


					<div class='form-group col-md-2'>

						{!! Form::label('operator', 'Оператор', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('operator', $operators, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('hotel', 'Отель', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">

							{!! Form::text ('hotel', null , [ 'class'=>"form-control"])!!}

						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('manager', 'Менеджер', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('manager', $managers, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('paginate', 'Показывать на странице', ['class'=>'control-label col-md-9'])!!}
						
						<div class="col-md-3">
							{!! Form::select ('paginate', [10=>'10', 20=>'20', 30=>'30', 50=>'50', 100 => '100'], 10 , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

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
					    <th class="sort" id="created_at" active="not" next_sort="desc">Создана</th>
					    <th>Код-туроператора</th>
					    <th>Менеджер</th>
					    <th>Вылет из:</th>
					    <th  class="sort" id="date_depart" active="not" next_sort="desc">Дата вылета</th>
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

