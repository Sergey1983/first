<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<h1>Список туров</h1>

		</div>

	</div>

	<div class="row">

		<div class="col-md-12">
	
			<table class='table table-striped table-hover table-responsive'>
				
				<thead>
					<tr >
					    <th>Id заявки</th>
					    <th>Вылет из:</th>
					    <th>Отель</th>
					    <th></th>
				  	</tr>
				</thead>
			@foreach ($tours as $tour)
				<tbody>
				
					<tr>

						<td><?= $tour->id ?></td>
						<td><?= $tour->city_from ?></td>
						<td><?= $tour->hotel ?></td>
						<td><?= '<a class="btn btn-sm btn-info" href="/tours_2/' . $tour->id . '">
						Подробнее
						</a>' ?></td>

					</tr>

				</tbody>

			@endforeach

			</table>

		</div>

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

