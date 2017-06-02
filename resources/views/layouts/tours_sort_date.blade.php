	<h1>Сортировать по дате вылета</h1> 


	

				<form method='get'>

				{{ csrf_field() }}


				<span>От: </span><input type="date" name="from">

				<span>До: </span><input type="date" name="to"><br><br>
			
				<input type="submit" value="Сортировать">

				</form> <br>

				<a href="/tours" class="a-button">
					<button>Отменить сортировку</button>
				</a>
