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

    <script type="text/javascript" src="{{ URL::asset('js/ajax_setup.js') }}"></script>
    
</head>
<body>

@if (Auth::check())

<div class="container-fluid">
	<div class="col-md-12 text-right">
		{{ Auth::user()->name}}
		<a href="/logout">logout</a>
	</div>
</div>

@endif


<div class = 'container-fluid'>

	<div class="row text-center">
		<div class="col-md-12">		
			<h3>ВИСТА-ТУР <small>ОРЕНБУРГ</small></h3>
		</div>
	</div>
	
</div>


@yield('content')



</body>
</html>