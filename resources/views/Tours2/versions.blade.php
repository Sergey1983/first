@extends('layouts.master')

@section ('content')


@for ($i=0; $i<count($versions); $i++) 


<div class="container-fluid">

	<h3>Версия <?=$versions[$i]['this_version']?> </h3>

	<div>Создана: <?=$versions[$i]['version_created'] ?> </div>

</div>

<div class="container-fluid">

	<table class='table table-striped table-hover table-responsive'>
			
				<tr>

				    <th class='col-md-3'>Id заявки</th>
				    <th class='col-md-3'>Вылет из:</th>
				    <th class='col-md-3'>Отель</th>
				    <th class='col-md-3'>Создана менеджером</th>
			  	
			  	</tr>

				<tr>

					<td><?= $id ?></td>
					<td><?= $versions[$i]['tour']['city_from'] ?></td>
					<td><?= $versions[$i]['tour']['hotel'] ?></td>
					<td><?= $versions[$i]['user'] ?></td>


				</tr>
			
			</table>

</div>



<div class="container-fluid">

		<table class='table table-striped table-hover table-responsive'>

			<tr>

			    <th>Id туриста</th>
			    <th>Имя</th>
			    <th>Фамилия</th>
			    <th>Дата рождения</th>
			    <th>Номер док-та</th>
			    <th>Покупатель?</th>
			    <th>Турист?</th>
			    
		  	</tr>

		@foreach ($versions[$i]['tourists'] as $tourist)

			<tr>


				<td><?= $tourist['tourist_id'] ?></td>
				<td><?= $tourist['name'] ?></td>
				<td><?= $tourist['lastName'] ?></td>
				<?php
				 $date = date_create_from_format('Y-m-d', $tourist['birth_date']) 
				?>
				<td><?= date_format($date, 'd-m-Y') ?></td>
				<td><?=$tourist['doc_fullnumber'] ?></td>	
				<td><?=$tourist['is_buyer'] ?></td>	
				<td><?=$tourist['is_tourist'] ?></td>	

			</tr>



		@endforeach

		</table>
		
</div>


@endfor



@endsection