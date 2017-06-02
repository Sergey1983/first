<?php



Route::get('/', 'WelcomeController@index');




Route::get('/tours', 'ToursController@index')->name('tours_list');

Route::get('/tours/create', 'ToursController@create');

Route::post('/tours/create', 'ToursController@store');

Route::get('/tours/{id}', 'ToursController@show');

Route::post('/tours/{id}', 'ToursController@update');




Route::get('/test', 'TestController@index');
Route::get('/search', 'TestController@search');

Route::get('/test2', 'TestController2@index');
Route::get('/load_tours', 'TestController2@load_tours');



Route::get('/test3', 'TestFormController@index');
Route::get('/test3/result', 'TestFormController@search');


Route::get('/tours_2', 'Tours2Controller@index');
Route::get('/tours_2/create', 'Tours2Controller@create');
Route::get('/tours_2/{id}', 'Tours2Controller@show');
Route::post('/tours_2/create', 'Tours2Controller@store');