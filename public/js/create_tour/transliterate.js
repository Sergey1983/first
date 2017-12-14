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

	var arr={'а':'A', 'б':'B', 'в':'V', 'г':'G', 'д':'D', 'е':'E', 'ё':'E', 'ж':'ZH', 'з':'Z', 'и':'I', 'й':'I', 'к':'K', 'л':'L', 'м':'M', 'н':'N', 
	'о':'O', 'п':'P', 'р':'R', 'с':'S', 'т':'T', 'у':'U', 'ф':'F',  'х':'KH', 'ц':'TS', 'ч':'CH', 'ш':'SH', 'щ':'SHCH', 'ъ':'IE', 'ь':'', 
	'ы':'Y', 'э':'E', 'ю':'IU', 'я':'IA',
			 'А':'A', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Е', 'Ж':'ZH', 'З':'Z', 'И':'I', 'Й':'I', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 
	'О':'O', 'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Х':'KH', 'Ц':'TS', 'Ч':'CH', 'Ш':'SH', 'Щ':'SHCH', 'Ъ':'IE', 'Ь':'',
	 'Ы':'Y', 'Э':'E', 'Ю':'IU', 'Я':'IA'};

	// var replacer=function(a){return arr[a]||a};

	var replacer=function(a){return arr[a]};

	return str.replace(/[А-яёЁ]/g,replacer)

	}



})