		<h1>Тур <?= $tour->id ?></h1>

		<table>
		
			<tr>
		    <th>Id заявки</th>
		    <th>Вылет из:</th>
		    <th>Отель</th>
		    <th></th>
		  	</tr>

			<tr>

			<td><?= $tour->id ?></td>
			<td><?= $tour->сity_from ?></td>
			<td><?= $tour->hotel ?></td>
			<td><?= '<a href="/tours/' .$tour->id. '">
			<button>Подробнее</button> 
			</a>' ?></td>

			</tr>
		</table>
<br><br>



		<table>

			<tr>
		    <th>Id туриста</th>
		    <th>Имя</th>
		    <th>Фамилия</th>
		    <th>Дата рождения</th>
		  	</tr>


			<tr>

		@foreach ($tour_tourists as $tour_tourist)




			<td><?= $tour_tourist->id ?></td>
			<td><?= $tour_tourist->name ?></td>
			<td><?= $tour_tourist->lastName ?></td>
			<td><?= $tour_tourist->birth_date ?></td>
			

			</tr>



		@endforeach

		</table>


