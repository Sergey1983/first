
	<div class="row">


		<div class="col-md-12">

			{!! Form::open(['id'=>'search', 'class'=>'form', 'hidden'=>'hidden']) !!}
	{{-- 	{!! Form::select ('actuality', ['Да'=>'Да', 'Нет' => 'Нет', 'Любые'=> 'Любые'], null, ['class'=>"form-control"])!!}
	 --}}
				{!! Form::text ('actuality', null, [ 'class'=>"form-control"])!!}
				{!! Form::text ('status', null, [ 'class'=>"form-control"])!!}

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
				{!! Form::text ('product', null, [ 'class'=>"form-control"])!!}

		{{--  				{!! Form::select ('paginate', [10=>'10', 20=>'20', 30=>'30', 50=>'50', 100 => '100'], null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!} --}}

				{!! Form::text ('paginate', null, [ 'class'=>"form-control"])!!}


				{!! Form::text ('tourist_name', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('tourist_lastname', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('branch', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('accounting_no_debt', null , [ 'class'=>"form-control"])!!}




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

					 		<div class="col-md-6 medium-label">

								<medium>Актуальные</medium>		 			

					 		</div>

					 		<div class="col-md-6 medium-label">

								<medium>Скрыть аннулированные</medium>		 			

					 		</div>

							<div class="btn-group btn-group-md col-md-6" data-toggle="buttons">

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

							<div class="btn-group btn-group-md col-md-6" data-toggle="buttons">

							      <label class="btn btn-primary active">
							    
							        <input type="radio" name="status_f" value="Да" checked="checked">Да
							    
							      </label>
							    
							      <label class="btn btn-primary">
							    
							        <input type="radio" name="status_f" value="Нет">Нет
							    
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


@isset($accounting)
					 	<div class="form-group">

					 		<div class="col-md-12 medium-label">

								<medium>Скрыть заявки без долгов</medium>		 			

					 		</div>


							<div class="btn-group btn-group-md col-md-12" data-toggle="buttons">

							      <label class="btn btn-primary active">
							    
							        <input type="radio" name="accounting_no_debt_f" value="Да" checked="">Да
							    
							      </label>
							    
							      <label class="btn btn-primary">
							    
							        <input type="radio" name="accounting_no_debt_f" value="Нет" >Нет
							    
							      </label>
							    
							</div>
							
						</div>

@endisset
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

								{!! Form::select ('product_f', ['Пакетный'=>'Пакетный тур', 'Авиа'=> 'Авиа', 'Отельный'=>'Отельный'], null , ['placeholder' =>  'Выберите', 'class'=>"form-control"])!!}
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

			</div>

		</div>


