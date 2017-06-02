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