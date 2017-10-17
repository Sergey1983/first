<?php




Route::get('/', function()
{
	return view('welcome');
});

Route::post('/login', ['as' => 'sessions.login', 'uses' => 'SessionsController@login']);

Route::get('/logout', ['as' => 'sessions.logout', 'uses' => 'SessionsController@logout']);




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
Route::get('/test3/result', 'TestFormContPaymentTouristControllerroller@search');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/tours_2', 'Tours2Controller@index')->name('tours2_index');
	Route::get('/tours_2/create', ['as' => 'tour.create', 'uses' => 'Tours2Controller@create']);	
	Route::post('/tours_2/create', ['as' => 'tour.store', 'uses' => 'Tours2Controller@store']);


	Route::group(['middleware' => 'App\Http\Middleware\TourAccessMiddleware'], function () {

		Route::get('/tours_2/{id}', ['as'=> 'tour.show', 'uses'=>'Tours2Controller@show']);
		Route::get('/tours_2/{id}/edit/', 'Tours2Controller@edit');
		Route::post('/tours_2/{id}','Tours2Controller@update');
		Route::get('/tours_2/{id}/versions', ['as' => 'tour.version', 'uses' => 'VersionsController@show']);


		Route::get('/tours_2/{id}/booking', ['as' => 'booking.edit', 'uses' =>'BookingController@bookingEdit']);
		Route::post('/tours_2/{id}/booking', ['as' => 'booking.update', 'uses' =>'BookingController@bookingUpdate']);

		Route::get('/tours_2/{id}/pay_tourist', ['as' => 'payment_tourist.create', 'uses' =>'PaymentTouristController@create']);
		Route::post('/tours_2/{id}/pay_tourist/with_deleted', ['as' => 'payment_tourist.create.with_deleted', 'uses' =>'PaymentTouristController@create_with_deleted']);
		Route::post('/tours_2/{id}/pay_tourist', ['as' => 'payment_tourist.store', 'uses' =>'PaymentTouristController@store']);
		Route::post('/tours_2/{id}/pay_tourist/{payment_id}/delete', ['as' => 'payment_tourist.delete', 'uses' =>'PaymentTouristController@delete']);

		Route::get('/tours_2/{id}/pay_operator', ['as' => 'payment_operator.create', 'uses' =>'PaymentOperatorController@create']);
		Route::post('/tours_2/{id}/pay_operator/with_deleted', ['as' => 'payment_operator.create.with_deleted', 'uses' =>'PaymentOperatorController@create_with_deleted']);
		Route::post('/tours_2/{id}/pay_operator', ['as' => 'payment_operator.store', 'uses' =>'PaymentOperatorController@store']);
		Route::post('/tours_2/{id}/pay_operator/{payment_id}/delete', ['as' => 'payment_operator.delete', 'uses' =>'PaymentOperatorController@delete']);



	});


		Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {
			

			Route::get('/admin/user/all', ['as' => 'user.index', 'uses' => 'UserController@index']);
			Route::get('/admin/user/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
			Route::post('/admin/user/create', ['as' => 'user.store', 'uses' => 'UserController@store']);
			Route::get('/admin/user/{id}/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
			Route::post('/admin/user/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);
			Route::post('/admin/user/{id}/update_permission', ['as' => 'user.update_permission', 'uses' => 'UserController@update_permission']);
			Route::post('/admin/user/{id}/destroy', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);

			

		});

	Route::post('/checkpassport_function', "FunctionsController@check_passport");
	Route::post('/load_tours_function', 'FunctionsController@load_tours');
	Route::post('/find_passengers', 'FunctionsController@find_passengers');
	Route::post('/edit_tour_prepare_data', 'FunctionsController@edit_tour_prepare_data');
	Route::post('/airport_load', 'FunctionsController@airport_load');
	

	Route::post('/return_versions', 'VersionsController@return_versions');


	Route::get('/testform', ['as' => 'testform', 'uses' => 'FormController@create']);
	Route::post('/testform', 'FormController@store');
	Route::post('/loadtestform', ['as' => 'loadtests', 'uses' => 'FormController@loadtests']);

	Route::get('/sometest', 'FormController@sometest');

});


