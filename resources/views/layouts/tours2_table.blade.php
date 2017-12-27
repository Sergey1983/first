<div class="container-fluid margin-bottom-25">


	<div class="row">

		<div class="col-md-11">



			{!! Form::open(['id'=>'search', 'class'=>'form', 'hidden'=>'hidden']) !!}
{{-- 				{!! Form::select ('actuality', ['Да'=>'Да', 'Нет' => 'Нет', 'Любые'=> 'Любые'], null, ['class'=>"form-control"])!!}
 --}}
{!! Form::text ('actuality', null, [ 'class'=>"form-control"])!!}


 				{!! Form::date ('created_from', null, ['class'=>'form-control'])!!}
				{!! Form::date ('created_to', null, ['class'=>'form-control'])!!}
				{!! Form::date ('depart_from', null, ['class'=>'form-control'])!!}
				{!! Form::date ('depart_to', null, ['class'=>'form-control'])!!}
			    {!! Form::text ('operator', null, [ 'class'=>"form-control"])!!}

				{!! Form::text ('ids_from', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('ids_to', null , [ 'class'=>"form-control"])!!}

{{-- 				{!! Form::select ('country', $countries, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
 --}}
 {!! Form::text ('country', null, [ 'class'=>"form-control"])!!}
{{-- 				{!! Form::select ('operator', $operators, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
 --}}

				{!! Form::text ('hotel', null, [ 'class'=>"form-control"])!!}
{{-- 				{!! Form::select ('manager', $managers, null, ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
 --}}
				{!! Form::text ('manager', null, [ 'class'=>"form-control"])!!}

{{--  				{!! Form::select ('paginate', [10=>'10', 20=>'20', 30=>'30', 50=>'50', 100 => '100'], null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!} --}}

				{!! Form::text ('paginate', null, [ 'class'=>"form-control"])!!}


				{!! Form::text ('tourist_name', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('tourist_lastname', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('branch', null , [ 'class'=>"form-control"])!!}


			{!! Form::close() !!}



		{!! Form::open(['id' => 'search_f', 'class'=>'form'] ) !!}

	<div class = "row">
		
		 <div class="col-md-12 medium-label padding-left-15">

			<h5>Фильтры</h5>		 			

		</div>

	</div>


	<div class="row margin-bottom-10 filter-form">


		<div class="col-md-3 no-padding-left">
			

		 	<div class="form-group">

		 		<div class="col-md-12 medium-label">

					<medium>Актуальные</medium>		 			

		 		</div>


				<div class="btn-group btn-group-md col-md-12" data-toggle="buttons">

				      <label class="btn btn-primary active">
				    
				        <input type="radio" name="actuality_f" value="Да" checked="checked">Да
				    
				      </label>
				    
				      <label class="btn btn-primary">
				    
				        <input type="radio" name="actuality_f" value="Нет">Нет
				    
				      </label>
				    
				      <label class="btn btn-primary">
				    
				        <input type="radio" name="actuality_f" value="Любые">Любые
				    
				      </label>
				</div>

			</div>

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Дата создания</medium>		 			

		 		</div>
				
				<div class="col-md-6 no-padding-right">
					
					{!! Form::date ('created_from_f', null {{-- \Carbon\Carbon::createFromDate(1970, 12, 25) --}}, ['class'=>'form-control datepicker'])!!}

				</div>

				<div class="col-md-6 no-padding-right">
					
					{!! Form::date ('created_to_f', null {{-- \Carbon\Carbon::now() --}}, ['class'=>'form-control datepicker'])!!}
				</div>

			</div>

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Оператор</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::select ('operator_f', $operators, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}

				</div>

			</div>



		</div>


		<div class="col-md-3 no-padding-left">

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Номер заявки</medium>		 			

		 		</div>
				
				<div class="col-md-6 no-padding-right">
					
					{!! Form::text ('ids_from_f', null , [ 'class'=>"form-control"])!!}


				</div>

				<div class="col-md-6 no-padding-right">
					
					{!! Form::text ('ids_to_f', null , [ 'class'=>"form-control"])!!}
				
				</div>

			</div>

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Дата вылета</medium>		 			

		 		</div>
				
				<div class="col-md-6 no-padding-right">
					
					{!! Form::date ('depart_from_f', null {{-- \Carbon\Carbon::createFromDate(2005, 12, 25) --}}, ['class'=>'form-control datepicker'])!!}

				</div>

				<div class="col-md-6 no-padding-right">
					
					{!! Form::date ('depart_to_f', null {{-- \Carbon\Carbon::now() --}}, ['class'=>'form-control datepicker'])!!}

				</div>

			</div>


			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Менеджер</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::select ('manager_f', $managers, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}

				</div>

			</div>
							

		</div>


		<div class="col-md-3 no-padding-left">
			
			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Продукт</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::select ('product_f', ['Пакетный тур'=>'Пакетный тур', 'Авиа'=> 'Авиа', 'Отель'=>'Отель'], null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
				</div>

			</div>

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Турист Фамилия</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::text ('tourist_lastname_f', null , [ 'class'=>"form-control"])!!}

				</div>

			</div>

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Страна</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::select ('country_f', $countries, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}

				</div>

			</div>


		</div>

		<div class="col-md-3 no-padding-left">
			
			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Отель</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::text ('hotel_f', null , [ 'class'=>"form-control"])!!}

				</div>

			</div>

			<div class='form-group'>

		 		<div class="col-md-12 medium-label">

					<medium>Турист имя</medium>		 			

		 		</div>
				
				<div class="col-md-12 no-padding-right">

					{!! Form::text ('tourist_name_f', null , [ 'class'=>"form-control"])!!}

				</div>

			</div>

@php

$isAdmin = Auth::user()->isAdmin();

$col_size = $isAdmin ? 'col-md-6' : 'col-md-12';


@endphp

			<div class='form-group'>

				<div class="{{$col_size}} medium-label no-padding-right">

					<medium>Показывать заявок</medium>		 			

		 		</div>

@if($isAdmin)
				<div class="{{$col_size}} medium-label no-padding-right">

					<medium>Филиал</medium>		 			

		 		</div>

@endif				
				<div class="{{$col_size}} no-padding-right">

					{!! Form::select ('paginate_f', [10=>'10', 20=>'20', 30=>'30', 50=>'50', 100 => '100'], 10 , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
				</div>
				
@if($isAdmin)

				<div class="{{$col_size}} no-padding-right">

					{!! Form::select ('branch_f', $branches, null, ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
				</div>

@endif
			</div>



	</div>

	</div>

	<div class="row submit margin-bottom-10">

		<div class="col-md-12" id="divsubmit">

			{!! Form::button( 'Применить', ['id'=>'search_button', 'class' => 'inline btn btn-success']) !!}

		</div>

	</div>



			{!! Form::close()!!}

{{-- 

			{!! Form::open(['id' => 'search_f', 'class'=>'form'] ) !!}

				<div class="row">

					<div class='form-group col-md-2'>

						{!! Form::label('actuality_f', 'Актуальные', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('actuality_f', ['Да'=>'Да', 'Нет' => 'Нет', 'Любые'=> 'Любые'], 'Любые', ['class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-4'>

						{!! Form::label('created', 'Дата создания', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-4 no-padding">
							
							{!! Form::date ('created_from_f', null, ['class'=>'form-control'])!!}
						</div>

						<div class="col-md-4 no-padding">

							
							{!! Form::date ('created_to_f', null, ['class'=>'form-control'])!!}
						</div>

					</div>

					<div class='col-md-4 form-group'>

						{!! Form::label('created', 'Дата вылета', ['class'=>'control-label col-md-4'])!!}
						
						<div class="col-md-4 no-padding">
							
							{!! Form::date ('depart_from_f', null, ['class'=>'form-control'])!!}
						</div>

						<div class="col-md-4 no-padding">
							
							{!! Form::date ('depart_to_f', null, ['class'=>'form-control'])!!}

						</div>

					</div>



				</div>	

				<div class="row">

					<div class='form-group col-md-2'>

						{!! Form::label('country_f', 'Страна', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('country_f', $countries, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>


					<div class='form-group col-md-2'>

						{!! Form::label('operator_f', 'Оператор', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('operator_f', $operators, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('hotel_f', 'Отель', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">

							{!! Form::text ('hotel_f', null , [ 'class'=>"form-control"])!!}

						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('manager_f', 'Менеджер', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('manager_f', $managers, null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('product_f', 'Продукт', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('product_f', ['Пакетный тур'=>'Пакетный тур', 'Авиа'=> 'Авиа', 'Отель'=>'Отель'], null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>

					<div class='form-group col-md-2'>

						{!! Form::label('paginate_f', 'На стр.', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">
							{!! Form::select ('paginate_f', [10=>'10', 20=>'20', 30=>'30', 50=>'50', 100 => '100'], 10 , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
						</div>

					</div>

				</div>	


				<div class="row">
	

					<div class='form-group col-md-3'>

						{!! Form::label('tourist_name', 'Турист Имя', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">

							{!! Form::text ('tourist_name_f', null , [ 'class'=>"form-control"])!!}

						</div>

					</div>

					<div class='form-group col-md-4'>

						{!! Form::label('tourist_lastname_f', 'Турист фамилия', ['class'=>'control-label col-md-5'])!!}
						
						<div class="col-md-7">

							{!! Form::text ('tourist_lastname_f', null , [ 'class'=>"form-control"])!!}

						</div>

					</div>

				</div>



				<div class="row submit" >

					<div class="col-md-6" id="divsubmit">

					{!! Form::button( 'Применить', ['id'=>'search_button', 'class' => 'inline btn btn-success']) !!}

					</div>

				</div>

			{!! Form::close()!!} --}}


		</div>

	</div>





	<div class="row">

		<div class="col-md-12">
	
			<table class='table table-striped table-hover table-responsive no-margin-bottom'>
				
				<thead>
					<tr >
					    <th>№</th>
					    <th class="sort" id="created_at" active="not" next_sort="desc">Создана</th>
					    <th>C</th>
					    <th>Код-туроператора</th>
					    <th>Менеджер</th>
					    <th>Заказчик</th>
					    <th>Чел.</th>
					    <th>Страна:</th>
					    <th>Продукт:</th>
					    <th class="sort" id="date_depart" active="not" next_sort="desc">Вылет</th>
					    <th>Ночей</th>
					    <th colspan="2">Стоимость</th>
					    <th>%</th>
					    <th style="word-break: break-word">Долг клиента </th>
					    <th colspan="2">К оплате</th>
					    <th></th>
				  	</tr>
				</thead>
{{-- 			@foreach ($tours as $tour)
 --}}			<tbody id="tbody_tours">
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

					</tr> --}}

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

</div>


