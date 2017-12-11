<?php


Route::get('generate-docx', 'HomeController@generateDocx');


Route::get('/', function()
{
	if(!Auth::check()) {
	
		return view('welcome');

	} else {

		return redirect()->route('home');

	}

})->name('login');

Route::post('/login', ['as' => 'sessions.login', 'uses' => 'SessionsController@login']);

Route::get('/logout', ['as' => 'sessions.logout', 'uses' => 'SessionsController@logout']);



Route::get('/tours', 'ToursController@index')->name('tours_list');

Route::get('/tours/create', 'ToursController@create');

Route::post('/tours/create', 'ToursController@store');

Route::get('/tours/{id}', 'ToursController@show');

Route::post('/tours/{id}', 'ToursController@update');




Route::get('/test', 'TestController@index');
Route::get('/search', 'TestController@search');

Route::get('/test2', 'TestController2@test');
// Route::get('/load_tours', 'TestController2@load_tours');



Route::get('/test3', 'TestFormController@index');
Route::post('/test3', 'TestFormController@store');


Route::group(['middleware' => 'auth'], function () {

	Route::get('/tours_2', ['as' => 'home', 'uses' => 'Tours2Controller@index']);
	Route::get('/tours_2/create/{tour_type}', ['as' => 'tour.create', 'uses' => 'Tours2Controller@create']);	
	Route::post('/tours_2/create', ['as' => 'tour.store', 'uses' => 'Tours2Controller@store']);


	Route::group(['middleware' => 'App\Http\Middleware\TourAccessMiddleware'], function () {

		Route::get( '/download/contracts/{id}/{filename}', 'TestController@download');

		Route::get('/tours_2/load_tours_function', 'FunctionsController@load_tours');
		Route::get('/tours_2/{tour}', ['as'=> 'tour.show', 'uses'=>'Tours2Controller@show']);
		Route::get('/tours_2/{tour}/edit/{tour_type}',['as'=>'tour.edit', 'uses' => 'Tours2Controller@edit']);
		Route::post('/tours_2/{tour}',['as'=>'tour.update', 'uses' => 'Tours2Controller@update']);

		Route::get('/tours_2/{tour}/versions', ['as' => 'tour.versions', 'uses' => 'VersionsController@show']);
		// Route::get('/tours_2/{id}/versions#version{version}', ['as' => 'tour.versions', 'uses' => 'VersionsController@show']);

		// Route::get('/tours_2/{id}/versions', ['as' => 'tour.version', 'uses' => 'VersionsController@return_versions']);
		
		Route::get('/tours_2/print_contract/{tour}',['as'=>'contract.choose', 'uses' =>'PrintingController@choose']);
		Route::get('/tours_2/print_contract/{tour}/{doc_type}', ['as'=>'contract.show', 'uses' =>'PrintingController@show']);
		Route::get('/tours_2/print_contract/{tour}/print/{doc_type}', ['as'=>'contract.print', 'uses' => 'PrintingController@print_contract']);
		Route::get('/tours_2/{tour}/contract_versions', ['as' => 'contract.versions', 'uses' => 'PrintingController@versions']);
		Route::get('/download/{tour}/{filename}', ['as' => 'contract.download', 'uses' => 'PrintingController@download']);



		Route::get('/tours_2/{tour}/booking', ['as' => 'booking.edit', 'uses' =>'BookingController@bookingEdit']);
		Route::post('/tours_2/{tour}/booking', ['as' => 'booking.update', 'uses' =>'BookingController@bookingUpdate']);

		Route::get('/tours_2/{tour}/pay_tourist', ['as' => 'payment_tourist.create', 'uses' =>'PaymentTouristController@create']);
		Route::post('/tours_2/{tour}/pay_tourist', ['as' => 'payment_tourist.store', 'uses' =>'PaymentTouristController@store']);
		Route::post('/tours_2/{tour}/pay_tourist/with_deleted', ['as' => 'payment_tourist.create.with_deleted', 'uses' =>'PaymentTouristController@create_with_deleted']);
		Route::post('/tours_2/{tour}/pay_tourist/{payment_id}/delete', ['as' => 'payment_tourist.delete', 'uses' =>'PaymentTouristController@delete']);

		Route::get('/tours_2/{tour}/pay_operator', ['as' => 'payment_operator.create', 'uses' =>'PaymentOperatorController@create']);
		Route::post('/tours_2/{tour}/pay_operator', ['as' => 'payment_operator.store', 'uses' =>'PaymentOperatorController@store']);
		Route::post('/tours_2/{tour}/pay_operator/with_deleted', ['as' => 'payment_operator.create.with_deleted', 'uses' =>'PaymentOperatorController@create_with_deleted']);
		Route::post('/tours_2/{tour}/pay_operator/{payment_id}/delete', ['as' => 'payment_operator.delete', 'uses' =>'PaymentOperatorController@delete']);


	});


		Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {
			
			Route::get('/admin', function () {return view('admin_welcome'); })->name('admin.start'); 

			Route::get('/admin/user/all', ['as' => 'user.index', 'uses' => 'UserController@index']);
			Route::get('/admin/user/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
			Route::post('/admin/user/create', ['as' => 'user.store', 'uses' => 'UserController@store']);
			Route::get('/admin/user/{user}/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
			Route::post('/admin/user/{user}', ['as' => 'user.update', 'uses' => 'UserController@update']);
			Route::post('/admin/user/{user}/update_permission', ['as' => 'user.update_permission', 'uses' => 'UserController@update_permission']);
			Route::get('/admin/user/{user}/destroy', function(App\User $user) { return view('user.destroy-warning', compact('user'));} )->name('user.destroy-warning');
			Route::post('/admin/user/{user}/destroy', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
			Route::get('/admin/user/{user}/make-active', ['as' => 'user.make-active', 'uses' => 'UserController@make_active']);

			
			Route::get('admin/templates', function () { return view('Templates.template_welcome');})->name('admin.templates.start');
			Route::get('admin/templates/{tour_type}', ['as'=>'template.index', 'uses'=>'TemplateController@index']);

			Route::get('admin/templates/{tour_type}/{doc_type}/edit', ['as' => 'template.edit', 'uses' => 'TemplateController@edit']);
			Route::post('admin/templates/update', ['as' => 'template.update', 'uses' => 'TemplateController@update']);

			// Route::get('admin/templates/create', ['as' => 'template.create', 'uses' => 'TemplateController@create']);
			Route::post('admin/templates/store', ['as' => 'template.store', 'uses' => 'TemplateController@store']);
			Route::post('admin/templates/store_draft', ['as' => 'template_draft.store', 'uses' => 'TemplateController@store_draft']);
			Route::post('admin/templates/gethtml', ['as' => 'template.gethtml', 'uses' => 'TemplateController@getHtml']);
			Route::get('admin/templates/view/{template}', ['as' => 'template.show', 'uses' => 'TemplateController@template_show_version']);

			Route::resource('airports', 'AirportController');
			Route::resource('operators', 'OperatorsController');

		});

	Route::post('/checkpassport_function', "FunctionsController@check_passport");
	Route::get('/load_tours_function', 'FunctionsController@load_tours');
	// Route::get('/load_tours_function{page?}', 'FunctionsController@load_tours');

	Route::post('/find_passengers', 'FunctionsController@find_passengers');
	Route::post('/edit_tour_prepare_data', 'FunctionsController@edit_tour_prepare_data');
	Route::post('/airport_load', 'FunctionsController@airport_load');
    // Route::get('/load_tours', 'TestController2@load_tours');


	Route::post('/return_versions', 'VersionsController@return_versions');


	Route::get('/testform', ['as' => 'testform', 'uses' => 'FormController@create']);
	Route::post('/testform', 'FormController@store');
	Route::post('/loadtestform', ['as' => 'loadtests', 'uses' => 'FormController@loadtests']);

	Route::get('/sometest', 'FormController@sometest');

});


