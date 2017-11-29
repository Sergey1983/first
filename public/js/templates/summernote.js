
$(document).ready(function() {


	var doc_type = $('input[name="doc_type"]').val();

	var tour_type = $('input[name="tour_type"]').val();

$('#wysiwig').summernote({

			  	height:600,
			 	toolbar: [

			    ['style', ['bold', 'italic', 'clear']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['undo',  ['undo']],
				['redo', ['redo']],
				['table', ['table']],
				['codeview', ['codeview']],
				
			  ]
			  });



	$.ajax({

		method: 'POST', 
		url: url_gethtml,
		data: {
			'doc_type': doc_type, 
			'tour_type': tour_type
		}

		})
		.done(function(data){
		 
		 	html = data;

			$('#wysiwig').summernote('code', html);

		})
		.fail(function(){

			html = "Нет шаблона на сервере";


		})




$('#store_draft, #store').on('click', function (event) {


	var action = $(this).attr('id');

	event.preventDefault();
	
	if ($('#wysiwig').summernote('isEmpty')) {

		alert('Empty!');

	} else {

		var written = $('#wysiwig').summernote('code');
		
		console.log(written);

		$.ajax({

			method: 'POST', 
			url: url_admin_templates+'/'+action,
			data: {	'doc_type' : doc_type,
					'tour_type' : tour_type, 
					'template_text': written
				}

			})
			.done(function(){

				var location = undefined;

				switch(tour_type){

				case 'Пакетный': location = '/packet_tour'; break;

				case 'Отельный': location = '/hotel'; break;

				case 'Авиа': location = '/avia'; break;

				}

				window.location.href = '/admin/templates'+location;


			})
			.fail(function(){



			})

	}


		});

});