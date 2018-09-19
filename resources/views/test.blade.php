<!DOCTYPE html>
<html lang='ru' >
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" type="text/css" href="/css/app.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    
</head>
<body>





<form id="calculator">
  <input type="text" name="digit1">
  <input type="text" name="digit2">
  <input type="submit" value ="Посчитать">
  Результат: <span id="result"></span>
</form>

{{phpinfo()}}
</body>

</html>

<script type="text/javascript">

$(document).ready(function () {
	$('#sumbit').on('click', function (event){

		event.preventDefault();
		var a = $("input[name='digit1']").val();
		var b = $("input[name='digit2']").val();
    var c = a + b;
    $('#result').append(c);

	});

});

</script>

{{-- <? 
phpinfo(); --}}