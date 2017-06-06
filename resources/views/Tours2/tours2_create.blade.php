@extends('layouts.master')

@section ('content')

@include('layouts.tours2_create_table')


<?= dump($errors); ?>




<script type="text/javascript">
	

$(document).ready(function(){

	$('#add_passenger').on('click', function (event) {

		event.preventDefault();
		
		$new_passenger = $('<br><br><span>Имя: </span><input type="text" name="name[]" placeholder="Имя"><br><br><span>Фамилия: </span><input type="text" name="lastName[]" placeholder="Фамилия"><br><br><span>Дата рождения: </span><input type="date" name="birth_date[]" value="" placeholder="Дата рождения"><br><br><span>Номер док-та: </span><input type="text" name="doc_fullnumber[]" placeholder="Номер док-та"><br><br>	'

			);

		$('.inputs').append($new_passenger);
				

	})

})


</script>

@endsection



