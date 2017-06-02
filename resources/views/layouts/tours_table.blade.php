		<h1>Список туров</h1>

		<table>
		
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

		</table>