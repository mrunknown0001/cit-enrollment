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

Route::post('/cashier/login', 'LoginController@postCashierLogin')->name('cashier.login.post');

Route::get('/registrar/login', 'LoginController@registrarLogin')->name('registrar.login');

Route::post('/registrar/login', 'LoginController@postRegistrarLogin')->name('registrar.login.post');

Route::get('/registrar', function () {
	return redirect()->route('registrar.login');
});

Route::get('/faculty/login', 'LoginController@facultyLogin')->name('faculty.login');

Route::post('/faculty/login', 'LoginController@postFacultyLogin')->name('faculty.login.post');

Route::get('/faculty', function () {
	return redirect()->route('faculty.login');
});

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

	// route to view deans
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

	// route to view registrars
	Route::get('/registrars', 'AdminController@registrars')->name('admin.registrars');

	// route to add registrar
	Route::get('/registrar/add', 'AdminController@addRegistrar')->name('admin.add.registrar');

	// route to save new registrar
	Route::post('/registrar/add', 'AdminController@postAddRegistrar')->name('admin.add.registrar.post');

	// route to update registrar
	Route::get('/registrar/{id}/update', 'AdminController@updateRegistrar')->name('admin.update.registrar');

	// route to save update on registrar
	Route::post('/registrar/update', 'AdminController@postUpdateRegistrar')->name('admin.update.registrar.post');

	Route::get('/registrar/update', function () {
		return redirect()->route('admin.registrars');
	});

	// route to view cashiers
	Route::get('/cashiers', 'AdminController@cashiers')->name('admin.cashiers');

	// route to add cashier
	Route::get('/cashier/add', 'AdminController@addCashier')->name('admin.add.cashier');

	// rotue to save new cashier
	Route::post('/cashier/add', 'AdminController@postAddCashier')->name('admin.add.cashier.post');

	// route to update cashier
	Route::get('/cashier/{id}/update', 'AdminController@updateCashier')->name('admin.update.cashier');

	// route to save update on cashier
	Route::post('/cashier/update', 'AdminController@postUpdateCashier')->name('admin.update.cashier.post');

	Route::get('/cashier/update', function () {
		return redirect()->route('admin.cashiers');
	});

	// route to view faculties
	Route::get('/faculties', 'AdminController@faculties')->name('admin.faculties');

	// route to add faculty
	Route::get('/faculty/add', 'AdminController@addFaculty')->name('admin.add.faculty');

	// route to save new faculty
	Route::post('/faculty/add', 'AdminController@postAddFaculty')->name('admin.add.faculty.post');

	// route to update faculty
	Route::get('/faculty/{id}/update', 'AdminController@updateFaculty')->name('admin.update.faculty');

	// route to save update on faculty
	Route::post('/faculty/update', 'AdminController@postUpdateFaculty')->name('admin.update.faculty.post');

	Route::get('/faculty/update', function () {
		return redirect()->route('admin.faculties');
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
	// route to student dashboard
	Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');
});