	<a id='book_button' class = 'btn btn-warning' href="/tours_2/<?= $tour->id ?>/booking">
		{{ is_null($tour->operator_code) ? 'Подтвердить бронирование' : 'Изменить бронирование'}}
	</a>


