
<div class="container-fluid text-center">
			
	<h2>Тур <?= $tour->id ?></h2>

</div>


<div class="container-fluid">

	<h3> Описание тура: </h3>

	<table class='table table-striped table-hover table-responsive'>
	
		<tr>

		    <th class='col-md-3'>Id заявки</th>
		    <th class='col-md-3'>Вылет из:</th>
		    <th class='col-md-3'>Отель</th>
		    <th>Cоздана менеджером</th>
	  	
	  	</tr>

		<tr>

			<td ><?= $tour->id ?></td>
			<td><?= $tour->сity_from ?></td>
			<td><?= $tour->hotel ?></td>
			<td><?= $tour->tour_tourist->user->name ?></td>


		</tr>
	
	</table>

</div>



<div class="container-fluid">

	<h3> Туристы: </h3>


	<table class='table table-striped table-hover table-responsive'>


		<tr>

		    <th class='col-md-2'>Id туриста</th>
		    <th class='col-md-2'>Имя</th>
		    <th class='col-md-2'>Фамилия</th>
		    <th class='col-md-3'>Дата рождения</th>
		    <th class='col-md-3'>Номер док-та</th>
		    
	  	</tr>




	@foreach ($tour_tourists as $tour_tourist)

		<tr>


			<td><?= $tour_tourist->id ?></td>
			<td><?= $tour_tourist->name ?></td>
			<td><?= $tour_tourist->lastName ?></td>
			<?php
			 $date = date_create_from_format('Y-m-d', $tour_tourist->birth_date) 
			?>
			<td><?= date_format($date, 'd-m-Y') ?></td>
			<td><?= $tour_tourist->doc_fullnumber ?></td>		

		</tr>



	@endforeach

	</table>

</div>



