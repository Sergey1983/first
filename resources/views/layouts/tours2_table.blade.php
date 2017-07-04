		<h1>Список туров</h1>

		<table>
		
			<tr>
		    <th>Id заявки</th>
		    <th>Вылет из:</th>
		    <th>Отель</th>
		    <th></th>
		  	</tr>

		@foreach ($tours as $tour)




			<tr>

			<td><?= $tour->id ?></td>
			<td><?= $tour->сity_from ?></td>
			<td><?= $tour->hotel ?></td>
			<td><?= '<a href="/tours_2/' . $tour->id . '">
			<button>Подробнее</button> 
			</a>' ?></td>

			</tr>



		@endforeach

		</table>


	<h1>Список туров 2</h1>

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


<script type="text/javascript" src='{{URL::asset('js/load_tours/load_tours.js')}}'></script>