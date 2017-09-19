$(document).ready(function () {

	console.log("transliterate.js loaded");

	$(document).on('click', 'button[id*="transliterate"]', function () {

		var number = $(this).attr('id').replace('transliterate_', '');

		name = $('input[name="name['+number+']"]').val();
		lastName = $('input[name="lastName['+number+']"]').val();

		$('input[name="nameEng['+number+']"]').val(transliterate(name));
		$('input[name="lastNameEng['+number+']"]').val(transliterate(lastName));

	});


	function transliterate(str){

	var arr={'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ё':'e', 'ж':'gh', 'з':'z', 'и':'i', 'й':'y', 'к':'k', 'л':'l', 'м':'m', 'н':'n', 
	'о':'o', 'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'ы':'y', 'э':'e', 'А':'A', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Е', 
	 'Ж':'Gh', 'З':'Z', 'И':'I', 'Й':'Y', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O', 'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 
	 'Ы':'Y', 'Э':'E', 'ё':'yo', 'х':'h', 'ц':'c', 'ч':'ch', 'ш':'sh', 'щ':'sch', 'ъ':'y', 'ь':'y', 'ю':'yu', 'я':'ya', 'Ё':'YO', 'Х':'H', 
	 'Ц':'C', 'Ч':'CH', 'Ш':'SH', 'Щ':'SCH', 'Ъ':'Y', 'Ь':'Y', 'Ю':'YU', 'Я':'YA'};

	var replacer=function(a){return arr[a]||a};

	return str.replace(/[А-яёЁ]/g,replacer)

	}



})