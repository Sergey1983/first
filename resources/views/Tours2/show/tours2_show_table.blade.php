


@include('Tours2.show.'.$tour_type)



<div class="container-fluid margin-bottom-10">

	@include('buttons.book_tour')
    @include('buttons.pay_tourist')	

@unless(is_null($tour->operator_price_rub))	
	@include('buttons.pay_operator')
@endunless

</div>



<div class="container-fluid">


	@foreach ($tour_tourists_docs as $key => $tour_tourists_doc)

{{-- 	@php dd($tour_tourists_docs); @endphp
 --}}

	<h4> Турист {{$key+1}}: </h4>


	<div class="row">

		<div class="col-md-12">
		
			<table class="table table-responsive table-bordered table-striped">

				<tr>

				    <th>Id</th>
				    <th>Имя</th>
				    <th>Отчество</th>
				    <th>Фамилия</th>
				    <th>Имя Англ.</th>
				    <th>Фамилия Англ.</th>    
				    <th>День рож-я</th>
				    <th>Гражданство</th>
				    <th>Пол</th>
				    <th>Телефон</th>
				    <th>Email</th>

				</tr>

				<tr>

@php

	$tourist = $tour_tourists_doc->tourist;

@endphp


				    <td>{{$tourist->id}}</td>
				    <td>{{$tourist->name}}</td>
				    <td>{{$tourist->lastName}}</td>
				    <td>{{$tourist->patronymic}}</td>
				    <td>{{$tourist->nameEng}}</td>
				    <td>{{$tourist->lastNameEng}}</td>    
				    <td>{{$tourist->birth_date}}</td>
				    <td>{{$tourist->citizenship}}</td>
				    <td>{{$tourist->gender}}</td>
				    <td>{{$tourist->phone}}</td>
				    <td>{{$tourist->email}}</td>


				</tr>

			</table>

			</div>

			<div class="col-md-6">

					<table class="table table-responsive table-bordered table-striped">

						<tr>

						    <th class="col-md-4">Тип док-а 1</th>
						    <th class="col-md-4">Номер док-а</th>
						    <th class="col-md-2">Дата выдачи</th>
						    <th class="col-md-2">Дата окон-я</th>

						</tr>

						<tr>
@php

	$document = $tour_tourists_doc->document0;

@endphp
						    <td>{{$document->doc_type}}</td>
						    <td>{{$document->doc_number}}</td>
						    <td>{{$document->date_issue}}</td>
						    <td>{{$document->date_expire}}</td>
						
						</tr>


					</table>

@if($document->doc_type == 'Внутррос. паспорт')

					<table class="table table-responsive table-bordered table-striped ">

						<tr>

						    <th class="col-md-4">Кем выдан</th>
						    <th class="col-md-4">Адрес прописка</th>
						    <th class="col-md-4">Адрес фактич.</th>

						</tr>

						<tr>

						    <td>{{$document->who_issued}}</td>
						    <td>{{$document->address_pass}}</td>
						    <td>{{$document->address_real}}</td>
						
						</tr>




					</table>

	@endif

			</div>
			


@if($document = $tour_tourists_doc->document1)


			<div class="col-md-6">

					<table class="table table-responsive table-bordered table-striped">

						<tr>

						    <th class="col-md-4">Тип док-а 2</th>
						    <th class="col-md-4">Номер док-а</th>
						    <th class="col-md-2">Дата выдачи</th>
						    <th class="col-md-2">Дата окон-я</th>

						</tr>

						<tr>

						    <td>{{$document->doc_type}}</td>
						    <td>{{$document->doc_number}}</td>
						    <td>{{$document->date_issue}}</td>
						    <td>{{$document->date_expire}}</td>
						
						</tr>


					</table>

	@if($document->doc_type == 'Внутррос. паспорт')

					<table class="table table-responsive table-bordered table-striped">

						<tr>

						    <th class="col-md-4">Кем выдан</th>
						    <th class="col-md-4">Адрес прописка</th>
						    <th class="col-md-4">Адрес фактич.</th>

						</tr>

						<tr>

						    <td>{{$document->who_issued}}</td>
						    <td>{{$document->address_pass}}</td>
						    <td>{{$document->address_real}}</td>
						
						</tr>




					</table>

	@endif
			</div>
@endif

@if($tour_tourists_doc->is_buyer == 1)


	<div class="row">

		<div class="col-md-12">


			<div class="col-md-6">

					<table class="table table-responsive table-bordered table-striped">

						<tr>

						    <th class="col-md-4">Это заказчик?</th>
						    <th class="col-md-4">Закачик едет в тур?</th>

						</tr>

						<tr>

						    <td>Да</td>
						    <td>{{$tour_tourists_doc->is_buyer == 1 ? 'Да, едет' : 'Нет, не едет' }}</td>

						
						</tr>


					</table>

			</div>

		</div>

	</div>


@endif

	</div>


@endforeach





