@extends('layouts.master')

@section('content')


	<h1>Поиск по имени/фамилии</h1> 
	<form method='get'>
		{{ csrf_field() }}
		<input type="type" name="search" id="search" placeholder="имя или фамилию, pls" required>

	</form>

	<br><br>


		<table>
			<thead>
				<tr>
			    <th>Id заявки</th>
			    <th>Имя</th>
			    <th>Фамилия</th>
			    <th>Имя (Eng)</th>
			    <th>Фамилия (Eng)</th>
			    <th>Куда летит</th>
			    <th>Дата вылета</th>
			    <th></th>
			  	</tr>
		  	</thead>
		  	<tbody>
		  		

		@foreach ($tours as $tour)




			<tr>

			<td><?= $tour->id ?></td>
			<td><?= $tour->name ?></td>
			<td><?= $tour->lastName ?></td>
			<td><?= $tour->nameEng ?></td>
			<td><?= $tour->lastNameEng ?></td>
			<td><?= $tour->destination ?></td>
			<td><?= $tour->departure ?></td>
			<td><?= '<a href="/tours/' . $tour->id . '">
			<button>Редактировать</button> 
			</a>' ?></td>

			</tr>



		@endforeach
		  	

		  	</tbody>

		</table>

		<script type="text/javascript">
			
			$('#search').on('keyup', function () {
					$value=$(this).val();
					$.ajax({

						type: 'get',
						url: '{{URL::to('search')}}',
						data: {'search':$value},
						success:function (data) {
							$('tbody').html(data);
						}
					});
				})

		</script>

@endsection