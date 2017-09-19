$(document).ready(function(){
	
	console.log('mouse_over_dis_docs.js loaded');



	// $(document).on('mouseover', '[name*="doc_seria"][disabled] , [name*="doc_number"][disabled]', function () {

	$(document).on('mouseover', '.first-doc[disabled] , .first-doc[disabled]', function () {



		var it = $(this).parent()

					$('<div class="alert-validation">Выберите тип документа!</div>').appendTo(it).fadeOut(1300);


	});

})