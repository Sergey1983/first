	<h1>Поиск по имени/фамилии</h1> 
	<form action='/tours' method='get'>
		{{ csrf_field() }}
		<input type="type" name="search" placeholder="имя или фамилию, pls" required>
		<input type="submit" value="Искать">

	</form>