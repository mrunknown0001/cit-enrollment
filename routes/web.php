<?php

Route::get('/', 'GeneralController@landingPage')->name('landing.page');

Route::get('/home', function () {
	return redirect()->route('landing.page');
});

Route::get('/admin/login', 'LoginController@adminLogin')->name('admin.login');

Route::post('/admin/login', 'LoginController@postAdminLogin')->name('admin.login.post');

Route::get('/admin', function () {
	return redirect()->route('admin.login');
});

Route::get('/dean/login', 'LoginController@deanLogin')->name('dean.login');

Route::post('/dean/login', 'LoginController@postDeanLogin')->name('dean.login.post');

Route::get('/dean', function () {
	return redirect()->route('dean.login');
});

Route::get('/cashier/login', 'LoginController@cashierLogin')->name('cashier.login');

Route::get('/registrar/login', 'LoginController@registrarLogin')->name('registrar.login');

Route::get('/faculty/login', 'LoginController@facultyLogin')->name('faculty.login');

Route::get('/student/login', 'LoginController@studentLogin')->name('login');

Route::post('/student/login', 'LoginController@postStudentLogin')->name('student.login.post');

Route::get('/student', function () {
	return redirect()->route('student.login');
});

Route::get('/student/registration', 'RegistrationController@index')->name('student.registration');

Route::get('/logout', 'GeneralController@logout')->name('logout');

/*
 * Route group admin
 * route protected guard in controller 
 */
Route::group(['prefix' => 'admin'], function () {
	// route to admin dashboard
	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	// rotue to view deans
	Route::get('/deans', 'AdminController@deans')->name('admin.deans');

	// route to add dean
	Route::get('/dean/add', 'AdminController@addDean')->name('admin.add.dean');

	// route to save new dean
	Route::post('/dean/add', 'AdminController@postAddDean')->name('admin.add.dean.post');

	// route to update dean
	Route::get('/dean/{id}/update', 'AdminController@updateDean')->name('admin.update.dean');

	// route to save update on dean
	Route::post('/dean/update', 'AdminController@postUpdateDean')->name('admin.update.dean.post');

	Route::get('/dean/update', function () {
		return redirect()->route('admin.deans');
	});
});


/*
 * Route group dean
 */
Route::group(['prefix' => 'dean'], function () {
	// route to dean dashboard
	Route::get('/dashboard', 'DeanController@dashboard')->name('dean.dashboard');

});


/*
 * Route group cashier
 */
Route::group(['prefix' => 'cahier'], function () {
	// route to dean dashboard
	Route::get('/dashboard', 'CashierController@dashboard')->name('cashier.dashboard');
});


/*
 * Route group registrar
 */
Route::group(['prefix' => 'registrar'], function () {
	// route to dean dashboard
	Route::get('/dashboard', 'RegistrarController@dashboard')->name('registrar.dashboard');
});


/*
 * Route group faculty
 */
Route::group(['prefix' => 'faculty'], function () {
	// route to dean dashboard
	Route::get('/dashboard', 'FacultyController@dashboard')->name('faculty.dashboard');
});


/*
 * Route group student
 */
Route::group(['prefix' => 'student'], function () {
	// rotue to student dashboard
	Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');
});