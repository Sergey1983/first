<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/ajax_setup.js') }}"></script>
    <title></title>
</head>
<body>

<h2>ВИСТА-ТУР-ОРЕНБУРГ</h2>

@yield('content')


</body>
</html>