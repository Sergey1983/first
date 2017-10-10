$(document).ready(function () {

	console.log("transliterate.js loaded");

	$(document).on('focusout', 'input[name^="name["]', function () {

		var number = $(this).attr('name').replace('name[', '').replace(']', '');

		name = $('input[name="name['+number+']"]').val();

		$('input[name="nameEng['+number+']"]').val(transliterate(name));


	});

	$(document).on('focusout', 'input[name^="lastName["]', function () {

		var number = $(this).attr('name').replace('lastName[', '').replace(']', '');

		lastName = $('input[name="lastName['+number+']"]').val();

		$('input[name="lastNameEng['+number+']"]').val(transliterate(lastName));


	});



	function transliterate(str){

	var arr={'а':'A', 'б':'B', 'в':'V', 'г':'G', 'д':'D', 'е':'E', 'ё':'E', 'ж':'GH', 'з':'Z', 'и':'I', 'й':'Y', 'к':'K', 'л':'L', 'м':'M', 'н':'N', 
	'о':'O', 'п':'P', 'р':'R', 'с':'S', 'т':'T', 'у':'U', 'ф':'F', 'ы':'Y', 'э':'E', 'А':'A', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Е', 
	 'Ж':'Gh', 'З':'Z', 'И':'I', 'Й':'Y', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O', 'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 
	 'Ы':'Y', 'Э':'E', 'ё':'YO', 'х':'H', 'ц':'C', 'ч':'CH', 'ш':'SH', 'щ':'SCH', 'ъ':'Y', 'ь':'Y', 'ю':'YU', 'я':'YA', 'Ё':'YO', 'Х':'H', 
	 'Ц':'C', 'Ч':'CH', 'Ш':'SH', 'Щ':'SCH', 'Ъ':'Y', 'Ь':'Y', 'Ю':'YU', 'Я':'YA'};

	var replacer=function(a){return arr[a]||a};

	return str.replace(/[А-яёЁ]/g,replacer)

	}



})