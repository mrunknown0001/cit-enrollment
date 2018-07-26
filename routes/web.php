<?php

Route::get('/', 'GeneralController@landingPage')->name('landing.page');

Route::get('/registration', 'GeneralController@register')->name('registration');

Route::get('/student/registration', 'RegistrationController@studentShowDetails')->name('student.show.details');

Route::post('/student/registration', 'RegistrationController@postRegisterStudent')->name('registrer.student.post');

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

Route::get('/cashier', function () {
	return redirect()->route('cashier.login');
});

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

// Route::get('/student/registration', 'RegistrationController@index')->name('student.registration');

Route::get('/logout', 'GeneralController@logout')->name('logout');


/*
 * Route group admin
 * route protected guard in controller 
 */
Route::group(['prefix' => 'admin'], function () {
	// route to admin dashboard
	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	// route to enable enrollment
	Route::post('/enrollment/enable', 'AdminController@enableEnrollment')->name('admin.enable.enrollment');

	Route::get('/enrollment/enable', function () {
		return redirect()->route('admin.dashboard');
	});

	// route to disable enrollment
	Route::post('/enrollment/disable', 'AdminController@disableEnrollment')->name('admin.disable.enrollment');

	Route::get('/enrollment/disable', function () {
		return redirect()->route('admin.dashboard');
	});

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

	// route to view courses
	Route::get('/courses', 'AdminController@courses')->name('admin.courses');

	// route to add course
	Route::get('/course/add', 'AdminController@addCourse')->name('admin.add.course');

	// route to save new course
	Route::post('/course/add', 'AdminController@postAddCourse')->name('admin.add.course.post');

	// route to update course
	Route::get('/course/{id}/update', 'AdminController@updateCourse')->name('admin.update.course');

	Route::get('/course/update', function () {
		return redirect()->route('admin.courses');
	});

	// route to save update on course
	Route::post('/course/update', 'AdminController@postUpdateCourse')->name('admin.update.course.post');

	// route to view course major
	Route::get('/course/majors', 'AdminController@courseMajor')->name('admin.course.majors');

	// route to add course major
	Route::get('/course/major/add', 'AdminController@addCourseMajor')->name('admin.add.course.major');

	// route to save new course major
	Route::post('/course/major/add', 'AdminController@postAddCourseMajor')->name('admin.add.course.major.post');

	// route to update course major
	Route::get('/course/major/{id}/update', 'AdminController@updateCourseMajor')->name('admin.update.course.major');

	// route to save update on course major
	Route::post('/course/major/update', 'AdminController@postUpdateCourseMajor')->name('admin.update.course.major.post');

	Route::get('/course/major/update', function () {
		return redirect()->route('admin.course.majors');
	});

	// route to view all curriculum
	Route::get('/curricula', 'AdminController@curricula')->name('admin.curricula');

	// route to add curriculum
	Route::get('/curriculum/add', 'AdminController@addCurriculum')->name('admin.add.curriculum');

	// route to save new curriculum
	Route::post('/curriculum/add', 'AdminController@postAddCurriculum')->name('admin.add.curriculum.post');

	// route to update curriculum
	Route::get('/curriculum/{id}/update', 'AdminController@updateCurriculum')->name('admin.update.curriculum');

	// route to save update of curriculum
	Route::post('/curriculum/update', 'AdminController@postUpdateCurriculum')->name('admin.update.curriculum.post');

	Route::get('/curriculum/update', function () {
		return redirect()->route('admin.curricula');
	});

	// route to view academic year and settings
	Route::get('/academic/year', 'AdminController@academicYear')->name('admin.academic.year');

	// route to add new academic year
	Route::post('/academic/year/add', 'AdminController@postAddAcademicYear')->name('admin.add.academic.year');

	Route::get('/academic/year/add', function () {
		return redirect()->route('admin.academic.year');
	});

	// route to select second semester
	Route::post('/semester/select/second', 'AdminController@postSelectSecondSemester')->name('admin.select.second.semester.post');

	Route::get('/semester/select/second', function () {
		return redirect()->route('admin.academic.year');
	});

	// route to close academic year
	Route::post('/academic/year/close', 'AdminController@postCloseAcademicYear')->name('admin.close.academic.year.post');

	Route::get('/academic/year/close', function () {
		return redirect()->route('admin.academic.year');
	});

	// route to view year level
	Route::get('/year/level', 'AdminController@yearLevel')->name('admin.year.level');

	// rotue to add year level
	Route::get('/year/level/add', 'AdminController@addYearLevel')->name('admin.add.year.level');

	// route to save new year level
	Route::post('/year/level/add', 'AdminController@postAddYearLevel')->name('admin.add.year.level.post');

	// route to update year level
	Route::get('/year/level/{id}/update', 'AdminController@updateYearLevel')->name('admin.update.year.level');

	// route to save update on year level
	Route::post('/year/level/update', 'AdminController@postUpdateYearLevel')->name('admin.update.year.level.post');

	// route to view subjects
	Route::get('/subjects', 'AdminController@subjects')->name('admin.subjects');

	// route to add subject
	Route::get('/subject/add', 'AdminController@addSubject')->name('admin.add.subject');

	// route to get course major on selected course
	Route::get('/course/{id}/majors/get', 'AdminController@getCourseMajors')->name('admin.get.course.majors');

	// route to get course curriculum on selected course
	Route::get('/course/{id}/curriculum/get', 'AdminController@getCourseCurriculum')->name('admin.get.course.curriculum');

	// route to get curriculum based on major
	Route::get('/major/{id}/curriculum/get', 'AdminController@getMajorCurriculum')->name('admin.get.major.curriculum');

	// route to save new subject
	Route::post('/subject/add', 'AdminController@postAddSubject')->name('admin.add.subject.post');

	// route to update subject
	Route::get('/subject/{id}/update', 'AdminController@updateSubject')->name('admin.update.subject');

	// route to save update on subject
	Route::post('/subject/update', 'AdminController@postUpdateSubject')->name('admin.update.subject.post');

	Route::get('/subject/update', function () {
		return redirect()->route('admin.subjects');
	});

	// route to view activity logs
	Route::get('/activity-logs', 'AdminController@activityLogs')->name('admin.activity.logs');

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

	// route to student operations
	Route::get('/students', 'RegistrarController@students')->name('registrar.students');

	// route to add student
	Route::get('/student/add', 'RegistrarController@addStudent')->name('registrar.add.student');

	// route to save new student
	Route::post('/student/add', 'RegistrarController@postAddStudent')->name('registrar.add.student.post');

	// rotue to update student
	Route::get('/student/{id}/update', 'RegistrarController@updateStudent')->name('registrar.update.student');

	// route to save update student
	Route::post('/student/update', 'RegistrarController@postUpdateStudent')->name('registrar.update.student.post');

	// route to get major to be use in add student form
	Route::get('/course/{id}/majors/get', 'RegistrarController@getCourseMajor')->name('registrar.get.course.major');

	// route to get curriculum to use in add student form
	Route::get('/course/{id}/curriculum/get', 'RegistrarController@getCourseCurriculum')->name('registrar.get.course.curriculum');

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