<?php

use App\Tour;
use App\Services\Printing;
use App\Contract_template;

// Главная

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('home'));
});

//Главная > Создать тур

Breadcrumbs::register('tour.create', function ($breadcrumbs, $tour_type) {

	$tour_type = Printing::tour_type($tour_type);	
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Создать '.$tour_type.' тур', route('tour.create', $tour_type));
});



//Главная > [Заявка]

Breadcrumbs::register('tour.show', function ($breadcrumbs, $tour) {
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Заявка - '.$tour->id.'' , route('tour.show', $tour));
//('.Printing::tour_type($tour->tour_type).')';
});

//Главная > [Заявка] > Бронирвоание

Breadcrumbs::register('booking.edit', function ($breadcrumbs, $tour) {
	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Бронирование', route('booking.edit', $tour));

});


//Главная > [Заявка] > Оплата туриста

Breadcrumbs::register('payment_tourist.create', function ($breadcrumbs, $tour) {
	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Оплата туриста', route('payment_tourist.create', $tour));

});


//Главная > [Заявка] > Оплата оператору

Breadcrumbs::register('payment_operator.create', function ($breadcrumbs, $tour) {
	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Оплата оператору', route('payment_operator.create', $tour));

});

//Главная > [Заявка] > [Редактировать тур]

Breadcrumbs::register('tour.edit', function ($breadcrumbs, $tour, $tour_type) {

	$tour_type = Printing::tour_type($tour_type);	
	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Редактировать', route('tour.edit', [$tour, $tour_type]));
});


//Главная > [Заявка] > Печать

Breadcrumbs::register('contract.choose', function ($breadcrumbs, $tour) {

	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Печать', route('contract.choose', $tour));
});

//Главная > [Заявка] > Печать

Breadcrumbs::register('contract.show', function ($breadcrumbs, $tour, $doc_type) {

	$breadcrumbs->parent('contract.choose', $tour);
    $breadcrumbs->push(Printing::doc_type($doc_type), route('contract.show', [$tour, $doc_type]));
});

//Главная > [Заявка] > Версии

Breadcrumbs::register('tour.versions', function ($breadcrumbs, $tour) {

	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Версии', route('tour.versions', $tour));
});



//Главная > [Заявка] > Версии документов

Breadcrumbs::register('contract.versions', function ($breadcrumbs, $tour) {

	$breadcrumbs->parent('tour.show', $tour);
    $breadcrumbs->push('Версии документов', route('contract.versions', $tour));
});


//Главная > Панель админа

Breadcrumbs::register('admin.start', function ($breadcrumbs) {

	$breadcrumbs->parent('home');
    $breadcrumbs->push('Панель админа', route('admin.start'));
});


//Главная > Панель админа > Список менеджеров

Breadcrumbs::register('user.index', function ($breadcrumbs) {

	$breadcrumbs->parent('admin.start');
    $breadcrumbs->push('Список менеджеров', route('user.index'));
});


//Главная > Панель админа > Создать менеджера

Breadcrumbs::register('user.create', function ($breadcrumbs) {

	$breadcrumbs->parent('user.index');
    $breadcrumbs->push('Создать менеджера', route('user.create'));
});


//Главная > Панель админа > Редактировать менеджера

Breadcrumbs::register('user.edit', function ($breadcrumbs, $user) {

	$breadcrumbs->parent('user.index');
    $breadcrumbs->push('Редактировать менеджера', route('user.edit', $user));
});


//Главная > Панель админа > Шаблоны

Breadcrumbs::register('admin.templates.start', function ($breadcrumbs) {

	$breadcrumbs->parent('admin.start');
    $breadcrumbs->push('Шаблоны', route('admin.templates.start'));
});


//Главная > Панель админа > Шаблоны > [Вид тура]

Breadcrumbs::register('template.index', function ($breadcrumbs, $tour_type) {

	$breadcrumbs->parent('admin.templates.start');
    $breadcrumbs->push(Printing::tour_type($tour_type).' тур', route('template.index', $tour_type));
});


//Главная > Панель админа > Шаблоны > [Вид тура] > Создать/Редактировать

Breadcrumbs::register('template.edit', function ($breadcrumbs, $tour_type, $doc_type) {

	$doc_type_ru = Printing::doc_type($doc_type);
	$breadcrumbs->parent('template.index', $tour_type);
    $breadcrumbs->push('Создать / Править '.$doc_type_ru, route('template.edit', [$tour_type, $doc_type]));

});

//Главная > Панель админа > Шаблоны > Версия шаблона

Breadcrumbs::register('template.show', function ($breadcrumbs, $template) {

	$breadcrumbs->parent('template.index', Printing::tour_type_reverse($template->tour_type));
    $breadcrumbs->push($template->doc_type.' шаблон от '.$template->created_at, route('template.show', $template));
});