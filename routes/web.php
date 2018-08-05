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
	return redirect()->route('login');
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

	// route to view proifle of admin
	Route::get('/profile', 'AdminController@profile')->name('admin.profile');

	// route to update profile admin
	Route::get('/profile/update', 'AdminController@updateProfile')->name('admin.update.profile');

	// route to save update on admin profile
	Route::post('/profile/update', 'AdminController@postUpdateProfile')->name('admin.update.profile.post');

	// route to change password of the admin
	Route::get('/password/change', 'AdminController@changePassword')->name('admin.change.password');

	// route to save new password
	Route::post('/password/change', 'AdminController@postChangePassword')->name('admin.change.password.post');

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

	// route to save new cashier
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

	// route to view all students
	Route::get('/students', 'AdminController@students')->name('admin.students');

	// route to reset password of student
	Route::post('/student/reset/password', 'AdminController@postResetStudentPassword')->name('admin.reset.student.password.post');

	Route::get('/student/reset/password', function () {
		return abort(404);
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

	// route to add year level
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

	// route to show miscellaneous fee and unit price
	Route::get('/price-and-miscellaneous', 'AdminController@unitPriceMisc')->name('admin.unit.price.misc');

	// route to add misc fee
	Route::get('/miscellaneous/fee/add', 'AdminController@addMiscFee')->name('admin.add.misc.fee');

	// route to save new misc fee
	Route::post('/miscellaneous/fee/add', 'AdminController@postAddMiscFee')->name('admin.add.misc.fee.post');

	// route to update misc fee
	Route::get('/miscellaneous/fee/{id}/update', 'AdminController@updateMiscFee')->name('admin.update.misc.fee');

	// route to save updae on misc fee
	Route::post('/miscellaneous/fee/update', 'AdminController@postUpdateMiscFee')->name('admin.update.misc.fee.post');

	Route::get('/miscellaneous/fee/update', function () {
		return redirect()->route('admin.unit.price.misc');
	});

	// route to update unit price
	Route::get('/unit/price/update', 'AdminController@updateUnitPrice')->name('admin.update.unit.price');

	// route to save update in unit price
	Route::post('/unit/price/update', 'AdminController@postUpdateUnitPrice')->name('admin.update.unit.price.post');

	// route to show rooms management
	Route::get('/rooms', 'AdminController@rooms')->name('admin.rooms');

	// route to add room
	Route::get('/room/add', 'AdminController@addRoom')->name('admin.add.room');

	// route to save room
	Route::post('/room/add', 'AdminController@postAddRoom')->name('admin.add.room.post');

	// route to update room
	Route::get('/room/{id}/update', 'AdminController@updateRoom')->name('admin.update.room');

	// route to save room changes
	Route::post('/room/update', 'AdminController@postUpdateRoom')->name('admin.update.room.post');

	Route::get('/room/update', function () {
		return redirect()->route('admin.rooms');
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

	// route to view profile of the dean
	Route::get('/profile', 'DeanController@profile')->name('dean.profile');

	// route to update profile of the dean
	Route::get('/profile/update', 'DeanController@updateProfile')->name('dean.update.profile');

	// route to save update on profile of the dean
	Route::post('/profile/update', 'DeanController@postUpdateProfile')->name('dean.update.profile.post');

	// route to change password of the dean
	Route::get('/password/change', 'DeanController@changePassword')->name('dean.change.password');

	// route to save new password of the dean
	Route::post('/password/change', 'DeanController@postChangePassword')->name('dean.change.password.post');

	// route to view schedule management
	Route::get('/schedules', 'DeanController@schedules')->name('dean.schedules');

	// route to add schedule
	Route::get('/schedule/add', 'DeanController@addSchedule')->name('dean.add.schedule');

	// route to save new schedule
	Route::post('/schedule/add', 'DeanController@postAddSchedule')->name('dean.add.schedule.post');

});


/*
 * Route group registrar
 */
Route::group(['prefix' => 'registrar'], function () {
	// route to registrar dashboard
	Route::get('/dashboard', 'RegistrarController@dashboard')->name('registrar.dashboard');

	// route to view profile of registrar
	Route::get('/profile', 'RegistrarController@profile')->name('registrar.profile');

	// route to update profile of registrar
	Route::get('/profile/update', 'RegistrarController@updateProfile')->name('registrar.update.profile');

	// route to save update in profile of registrar
	Route::post('/profile/update', 'RegistrarController@postUpdateProfile')->name('registrar.update.profile.post');

	// route to change password for registrar
	Route::get('/password/change', 'RegistrarController@changePassword')->name('registrar.change.password');

	// route to save new password for registrar
	Route::post('/password/change', 'RegistrarController@postChangePassword')->name('registrar.change.password.post');

	// route to change password of registrar
	Route::get('/password/change', 'RegistrarController@changePassword')->name('registrar.change.password');

	// route to student operations
	Route::get('/students', 'RegistrarController@students')->name('registrar.students');

	// route to search students
	Route::get('/student/search', 'RegistrarController@searchStudent')->name('registrar.search.student');

	// route to add student
	Route::get('/student/add', 'RegistrarController@addStudent')->name('registrar.add.student');

	// route to save new student
	Route::post('/student/add', 'RegistrarController@postAddStudent')->name('registrar.add.student.post');

	// route to update student
	Route::get('/student/{id}/update', 'RegistrarController@updateStudent')->name('registrar.update.student');

	// route to save update student
	Route::post('/student/update', 'RegistrarController@postUpdateStudent')->name('registrar.update.student.post');

	// route to get major to be use in add student form
	Route::get('/course/{id}/majors/get', 'RegistrarController@getCourseMajor')->name('registrar.get.course.major');

	// route to get curriculum to use in add student form
	Route::get('/course/{id}/curriculum/get', 'RegistrarController@getCourseCurriculum')->name('registrar.get.course.curriculum');

});


/*
 * Route group cashier
 */
Route::group(['prefix' => 'cahier'], function () {
	// route to cashier dashboard
	Route::get('/dashboard', 'CashierController@dashboard')->name('cashier.dashboard');

	// route to view profile of cashier
	Route::get('/profile', 'CashierController@profile')->name('cashier.profile');

	// route to update profile of cashier
	Route::get('/profile/update', 'CashierController@updateProfile')->name('cashier.update.profile');

	// route to save update of profile
	Route::post('/profile/update', 'CashierController@postUpdateProfile')->name('cashier.update.profile.post');

	// route to change password of cashier
	Route::get('/password/change', 'CashierController@changePassword')->name('cashier.change.password');

	// route to save new password of cashier
	Route::post('/password/change', 'CashierController@postChangePassword')->name('cashier.change.password.post');

	// route to view all payments
	Route::get('/payments', 'CashierController@payments')->name('cashier.payments');
});


/*
 * Route group faculty
 */
Route::group(['prefix' => 'faculty'], function () {
	// route to faculty dashboard
	Route::get('/dashboard', 'FacultyController@dashboard')->name('faculty.dashboard');

	// route to view profile of faculty
	Route::get('/profile', 'FacultyController@profile')->name('faculty.profile');

	// route to update profile of faculty
	Route::get('/profile/update', 'FacultyController@updateProfile')->name('faculty.update.profile');

	// route to save update in profile of faculty
	Route::post('/profile/update', 'FacultyController@postUpdateProfile')->name('faculty.update.profile.post');

	// route to change password
	Route::get('/password/change', 'FacultyController@changePassword')->name('faculty.change.password');

	// route to save new password
	Route::post('/password/change', 'FacultyController@postChangePassword')->name('faculty.change.password.post');
});


/*
 * Route group student
 */
Route::group(['prefix' => 'student'], function () {
	// route to student dashboard
	Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');

	// route to view profile
	Route::get('/profile', 'StudentController@profile')->name('student.profile');

	// route to update profile
	Route::get('/profile/{id}/update', 'StudentController@updateProfile')->name('student.update.profile');

	// route to save proifle update
	Route::post('/profile/update', 'StudentController@postUpdateProfile')->name('student.update.profile.post');

	Route::get('/profile/update', function () {
		return redirect()->route('student.dashboard');
	});

	// route to change password of student
	Route::get('/password/change', 'StudentController@changePassword')->name('student.change.password');

	// route to save new password
	Route::post('/password/change', 'StudentController@postChangePassword')->name('student.change.password.post');

	// route to change profile image of the student
	Route::get('/profile/image/upload', 'StudentController@uploadProfileImage')->name('student.upload.profile.image');

	// route to save new profile image
	Route::post('/profile/image/upload', 'StudentController@postUploadProfileImage')->name('student.upload.profile.image.post');

	// route to show enrollment page
	Route::get('/enrollment', 'StudentController@enrollment')->name('student.enrollment');

	// route to show payments made
	Route::get('/payments', 'StudentController@payments')->name('student.payments');

	// route to go to paypal payment for registration payment
	Route::get('/payment/registration/paypal', 'StudentController@paypalRegistrationPayment')->name('student.paypal.registration.payment');

	// route to pay with paypal
	// Route::post('/payment/registration/paypal', 'PaymentController@payWithPaypal')->name('student.paypal.registration.payment.post');
	Route::post('/payment/registration/paypal', 'StudentController@RegistrationPaymentWithPaypal')->name('student.paypal.registration.payment.post');

	// route to show paypal payment status
	Route::get('/paypal/payment/status', 'PaymentController@getPaymentStatus')->name('student.paypal.payment.status');

	// route to go to card payment for registration payment
	Route::get('/payment/registration/card', 'StudentController@cardRegistrationPayment')->name('student.card.registration.payment');

	// route to card payment in registration payment
	Route::get('/payment/registration/card/review', 'StudentController@reviewCardRegistrationPayment')->name('student.review.card.registration.payment');

	// route to pay with card
	Route::post('/payment/registration/card', 'StudentController@postCardRegistrationPayment')->name('student.card.registration.payment.post');

});