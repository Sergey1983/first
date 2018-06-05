@extends('layouts.master')

@section('content')

<div class="container-fluid">
	
	<div id='wysiwig'></div>

	<button id = 'save' class="btn btn-success">Сохранить</button>

</div>



<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<script type="text/javascript">
	
$(document).ready(function() {
  $('#wysiwig').summernote({

  	height:600,
 	toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'clear']],
    // ['font', ['superscript', 'subscript']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['undo',  ['undo']],
	['redo', ['redo']],
	['table', ['table']],
	['codeview', ['codeview']]
  ]
  });


$('#save').on('click', function (event) {

	event.preventDefault();
	
	if ($('#wysiwig').summernote('isEmpty')) {

		alert('Empty!');

	} else {

		var written = $('#wysiwig').summernote('code');
		
		console.log(written);

		$.ajax({

			method: 'POST', 
			url: '{{ URL::asset('admin/templates/store') }}',
			data: {'template_text': written}

			})
			.done(function(){

				window.location.href = '/admin/templates';


			})
			.fail(function(){

				alert("Возникли проблемы при сохранении!!!");

			})

	}


		});

});


</script>

@endsection