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

<h2>Тестовая форма</h2>




{!! Form::open(['action' => 'FormController@store']) !!}

@for ($i=0; $i<2; $i++) 

	<div class='input'>
		{!! Form::label('Имя '.$i.'')!!}
		{!! Form::text('fullname['.$i.']')!!}

		{!!Form::label('Документ '.$i.'' )!!}
		{!! Form::text('document_num['.$i.']')!!}
	</div>	

@endfor


	<button type="submit">Добавить</button>

{!! Form::close() !!}


@if ($errors->any())
{{dd($errors)}}
@endif

<br><br>
<table> 
	<thead>
		<th>id</th>
		<th>fullname</th>
		<th>document_num</th>
	</thead>

	<tbody>
@foreach ($tests as $test)
		<tr>
			<td>{!! $test->id !!}</td>
			<td>{!! $test->fullname !!}</td>
			<td>{!! $test->document_num !!}</td>
		</tr>
@endforeach
	</tbody>
</table>

</body>
</html>