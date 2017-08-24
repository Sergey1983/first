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

<?php

if(isset($diff)) {
 dump($diff);
}
;

?>


{!! Form::open(['id' => 'form1', 'route' => 'testform', 'method' => 'POST']) !!}

@for ($i=0; $i<2; $i++) 

	<div class='input'>

	
		<div class='inline'>
			{!! Form::label('Имя '.$i.'')!!}
			{!! Form::text('fullname['.$i.']')!!}
		</div>

		<div class='inline'>
		{!!Form::label('Что-то '.$i.'' )!!}
		{!! Form::text('smth['.$i.']')!!}
		</div>
		<div class='inline'>
		{!!Form::label('Документ '.$i.'' )!!}
		{!! Form::text('document_num['.$i.']')!!}
		</div>
	</div>	

@endfor

		{!!Form::submit('Добавить', ['id'=>'submit1'])!!}

{!! Form::close() !!}


@if ($errors->any())
	
	{{dump($errors)}}

@endif



<br><br>
<table> 
	<thead>
		<th>id</th>
		<th>fullname</th>
		<th>smth</th>
		<th>document_num</th>
	</thead>

	<tbody id="tbody1">

	</tbody>
</table>

</body>
</html>


<script type="text/javascript">

	
$(document).ready(function () {

	fill_table();

// FORM AUTOFILLING
	
	var array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'x', 'y', 'z'];

	function random() {
		
		return Math.floor((Math.random()*10)+1);

	}

	var words_list = [];

	var fullname = $('[name*="fullname"]');
	var smth = $('[name*="smth"]');
	var document_num = $('[name*="document_num"]');

	for (i=0; i<fullname.length*2; i++) {

		var word = [];

		var word_length = random();

		for (j=0; j<word_length; j++) {

			var letter = array[random()];
			word.push(letter);

			

		}
		
		word = word.join('');

		words_list.push(word);
		

	}

	var j = 0;

	for (i=0; i<fullname.length; i+=1) {

		fullname.eq(i).val(words_list[j]);
		smth.eq(i).val(words_list[j+1]);

		j = j+2;


	}

	function getRandom(min, max) {
	    return Math.random() * (max - min) + min;
	}

	var numbers = [];

	for (i=0; i<document_num.length; i++) {

		var docnumber = []

		for (j=0; j<getRandom(3,9); j++){

			docnumber.push(random());				

		}

		document_num.eq(i).val(docnumber.join(''));

	}


// SUBMITTING FORM


	// $('#submit1').on('click', function (event) {

	// 	event.preventDefault();

	// 	send();

	// 	fill_table();

	// });

	function send () {
		
		$.ajax({
			type: 'POST', 
			url: '/testform', 
			data: $('#form1').serialize(),
		})
		.done(function(data) {

			console.log(data);

			var status = data[0]['status'];

			console.log(status);

			if(status == 'users were added!') {

				$('#submit1').after('<br><br>'+
					'<div>'+status+'</div>'
					);

			} else {

				$('#submit1').after('<br><br>'+
					'<div>'+status+'</div>'
					);


				for (var i = 1; i < data.length; i++) {
					
					var obj = data[i];

					console.log(obj);

					var index = obj['input_index'];

					$.each(obj, function (key, value) {
						
						if(key != 'input_index') {

							$('[name="'+key+'['+index+']"]').after('<p style="color:red">'+value+'</p>');

						}

					})

					submit2_cancel = $('<input type="submit" id="submit2" value="Сохранить с изменением туристов?">'+
						'<span>  </span>'+
						'<button type="button">Отменить</button>');

					$('#submit1').after(submit2_cancel);

					$('#submit1').remove();



				}
			}




		})
		.fail(function(data){

			console.log(data);

		});

	};



	function fill_table() {

	    $('#tbody1').empty();

		$.ajax({

			type: "POST", 
			url: "{{ route('loadtests') }}"

		})

		.done(function (data) {


			for (var i = 0; i < data.length; i++) {
				
				obj = data[i];


				
				$("#tbody1").append(
					'<tr>'+
						'<td>'+obj.id+'</td>'+
						'<td>'+obj.fullname+'</td>'+
						'<td>'+obj.smth+'</td>'+
						'<td>'+obj.document_num+'</td>'+
					'<tr>'						
				)

			}


		

		})

		.fail(function (data){

			console.log(data);
		
		});


	}






})

</script>