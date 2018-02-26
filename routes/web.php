<?php

Route::get('/test', function () {return view('test'); });

Route::get('generate-docx', 'HomeController@generateDocx');


Route::get('/', ['as'=>'sessions.loginindex', 'uses' => 'SessionsController@loginindex']);
Route::post('/login', ['as' => 'sessions.login', 'uses' => 'SessionsController@login']);
Route::get('/logout', ['as' => 'sessions.logout', 'uses' => 'SessionsController@logout']);
Route::get('refresh_captcha', 'SessionsController@refresh_captcha');

// Route::get('/tours', 'ToursController@index')->name('tours_list');

// Route::get('/tours/create', 'ToursController@create');

// Route::post('/tours/create', 'ToursController@store');

// Route::get('/tours/{id}', 'ToursController@show');

// Route::post('/tours/{id}', 'ToursController@update');




// Route::get('/test', 'TestController@index');
// Route::get('/search', 'TestController@search');

// Route::get('/test2', 'TestController2@test');
// Route::get('/load_tours', 'TestController2@load_tours');



// Route::get('/test3', 'TestFormController@index');
// Route::post('/test3', 'TestFormController@store');


Route::group(['middleware' => 'auth'], function () {

	Route::get('/tours', ['as' => 'home', 'uses' => 'ToursController@index']);
	Route::get('/tours/create/{tour_type}', ['as' => 'tour.create', 'uses' => 'ToursController@create']);	
	Route::post('/tours/create', ['as' => 'tour.store', 'uses' => 'ToursController@store']);


	Route::group(['middleware' => 'App\Http\Middleware\TourAccessMiddleware'], function () {

		Route::get('/tours/load_tours_function', 'FunctionsController@load_tours');
		Route::get('/tours/{tour}', ['as'=> 'tour.show', 'uses'=>'ToursController@show']);
		Route::get('/tours/{tour}/edit/{tour_type}',['as'=>'tour.edit', 'uses' => 'ToursController@edit']);
		Route::post('/tours/{tour}',['as'=>'tour.update', 'uses' => 'ToursController@update']);

		Route::get('/tours/{tour}/versions', ['as' => 'tour.versions', 'uses' => 'VersionsController@show']);
		// Route::get('/tours_2/{id}/versions#version{version}', ['as' => 'tour.versions', 'uses' => 'VersionsController@show']);

		// Route::get('/tours_2/{id}/versions', ['as' => 'tour.version', 'uses' => 'VersionsController@return_versions']);
		
		Route::get('/tours/print_contract/{tour}',['as'=>'contract.choose', 'uses' =>'PrintingController@choose']);
		Route::get('/tours/print_contract/{tour}/{doc_type}', ['as'=>'contract.show', 'uses' =>'PrintingController@show']);
		Route::get('/tours/print_contract/{tour}/print/{doc_type}', ['as'=>'contract.print', 'uses' => 'PrintingController@print_contract']);
		Route::get('/tours/{tour}/contract_versions', ['as' => 'contract.versions', 'uses' => 'PrintingController@versions']);
		Route::get('/download/{tour}/{filename}', ['as' => 'contract.download', 'uses' => 'PrintingController@download']);



		Route::get('/tours/{tour}/booking', ['as' => 'booking.edit', 'uses' =>'BookingController@bookingEdit']);
		Route::post('/tours/{tour}/booking', ['as' => 'booking.update', 'uses' =>'BookingController@bookingUpdate']);

		Route::get('/tours/{tour}/pay_tourist', ['as' => 'payment_tourist.create', 'uses' =>'PaymentTouristController@create']);
		Route::post('/tours/{tour}/pay_tourist', ['as' => 'payment_tourist.store', 'uses' =>'PaymentTouristController@store']);
		Route::post('/tours/{tour}/pay_tourist/with_deleted', ['as' => 'payment_tourist.create.with_deleted', 'uses' =>'PaymentTouristController@create_with_deleted']);
		Route::post('/tours/{tour}/pay_tourist/{payment_id}/delete', ['as' => 'payment_tourist.delete', 'uses' =>'PaymentTouristController@delete']);

		Route::get('/tours/{tour}/pay_operator', ['as' => 'payment_operator.create', 'uses' =>'PaymentOperatorController@create']);
		Route::post('/tours/{tour}/pay_operator', ['as' => 'payment_operator.store', 'uses' =>'PaymentOperatorController@store']);
		Route::post('/tours/{tour}/pay_operator/with_deleted', ['as' => 'payment_operator.create.with_deleted', 'uses' =>'PaymentOperatorController@create_with_deleted']);
		Route::post('/tours/{tour}/pay_operator/{payment_id}/delete', ['as' => 'payment_operator.delete', 'uses' =>'PaymentOperatorController@delete']);


	});


		Route::group(['middleware' => 'admin'], function () {
			
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
			Route::resource('branches', 'BranchesController');
			Route::resource('pay_methods', 'PayMethodController');

			Route::get('/admin/tourist_payments/all', ['as' => 'tourist_payments.index', 'uses' => 'PaymentTouristController@list']);
			// Route::post('/admin/tourist_payments/all', ['as' => 'tourist_payments.index_post', 'uses' => 'PaymentTouristController@list']);

		});

	Route::post('/checkpassport_function', "FunctionsController@check_passport");
	Route::get('/load_tours_function', 'FunctionsController@load_tours');
	Route::post('/find_passengers', 'FunctionsController@find_passengers');
	Route::post('/edit_tour_prepare_data', 'FunctionsController@edit_tour_prepare_data');
	Route::post('/airport_load', 'FunctionsController@airport_load');
	Route::post('/return_versions', 'VersionsController@return_versions');
	Route::post('/zagran_ne_gotov_number', '\App\Services\ZagranNeGotovFunctions@get_number');	


	// Route::get('/testform', ['as' => 'testform', 'uses' => 'FormController@create']);
	// Route::post('/testform', 'FormController@store');
	// Route::post('/loadtestform', ['as' => 'loadtests', 'uses' => 'FormController@loadtests']);

	// Route::get('/sometest', 'FormController@sometest');

});


