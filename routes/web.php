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



Route::get('/tours_2', 'Tours2Controller@index')->name('tours2_index');
Route::get('/tours_2/create', 'Tours2Controller@create');	
Route::post('/tours_2/create', 'Tours2Controller@store');
Route::get('/tours_2/{id}', 'Tours2Controller@show');
Route::get('/tours_2/{id}/edit/', 'Tours2Controller@edit');
Route::post('/tours_2/{id}','Tours2Controller@update');





Route::post('/checkpassport_function', "FunctionsController@check_passport");
Route::post('/load_tours_function', 'FunctionsController@load_tours');
Route::post('/tours_2/find_passengers', 'FunctionsController@find_passengers');
Route::post('/edit_tour_prepare_data', 'FunctionsController@edit_tour_prepare_data');


Route::get('/testform', 'FormController@create');
Route::post('/testform', 'FormController@store');


// Route::post('/addtourist', 'TouristController@store');


