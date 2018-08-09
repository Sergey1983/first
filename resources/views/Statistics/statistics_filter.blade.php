
<!-- 	<div class="row">
 -->
		<div class="col-md-12">

			{!! Form::open(['id'=>'search', 'class'=>'form', 'hidden'=>'hidden']) !!}
	
				{!! Form::text ('actuality', null, [ 'class'=>"form-control"])!!}
				{!! Form::date ('created_from', null, ['class'=>'form-control'])!!}
				{!! Form::date ('created_to', null, ['class'=>'form-control'])!!}
				{!! Form::date ('depart_from', null, ['class'=>'form-control'])!!}
				{!! Form::date ('depart_to', null, ['class'=>'form-control'])!!}
	
				{!! Form::text ('ids_from', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('ids_to', null , [ 'class'=>"form-control"])!!}
				{!! Form::text ('report_type', null, [ 'class'=>"form-control"])!!}

	
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

								<medium>Тип отчета</medium>		 			

					 		</div>
							
							<div class="col-md-12 no-padding-right">
								
								{!! Form::select ('report_type_f', $report_types, 'Туроператоры' , [null, 'class'=>"form-control"])!!}

							</div>

						</div>


					</div>


					<div class="col-md-3 no-padding-left">

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

								<medium>Дата создания</medium>		 			

					 		</div>
							
							<div class="col-md-6 no-padding-right">
								
								{!! Form::date ('created_from_f', null {{-- \Carbon\Carbon::createFromDate(1970, 12, 25) --}}, ['class'=>'form-control datepicker'])!!}

							</div>

							<div class="col-md-6 no-padding-right">
								
								{!! Form::date ('created_to_f', null {{-- \Carbon\Carbon::now() --}}, ['class'=>'form-control datepicker'])!!}
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


					</div>


				</div>

				<div class="row submit margin-bottom-10">

					<div class="col-md-12" id="divsubmit">

						{!! Form::button( 'Применить', ['id'=>'search_button', 'class' => 'inline btn btn-success']) !!}

					</div>

				</div>

				{!! Form::close()!!}

			</div>

<!-- 		</div>
 -->

