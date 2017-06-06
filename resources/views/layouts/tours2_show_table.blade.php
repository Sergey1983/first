		<h1>Тур <?= $tour->id ?></h1>

		<table>
		
			<tr>

			    <th>Id заявки</th>
			    <th>Вылет из:</th>
			    <th>Отель</th>
		  	
		  	</tr>

			<tr>

				<td><?= $tour->id ?></td>
				<td><?= $tour->сity_from ?></td>
				<td><?= $tour->hotel ?></td>

			</tr>
		
		</table>


<br><br>



		<table>

			<tr>

			    <th>Id туриста</th>
			    <th>Имя</th>
			    <th>Фамилия</th>
			    <th>Дата рождения</th>
			    <th>Номер док-та</th>
			    
		  	</tr>




		@foreach ($tour_tourists as $tour_tourist)

			<tr>


				<td><?= $tour_tourist->id ?></td>
				<td><?= $tour_tourist->name ?></td>
				<td><?= $tour_tourist->lastName ?></td>
				<td><?= $tour_tourist->birth_date ?></td>
				<td><?= $tour_tourist->doc_fullnumber ?></td>		

			</tr>



		@endforeach

		</table>


