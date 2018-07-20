<?php

Route::get('/', 'GeneralController@landingPage')->name('landing.page');

Route::get('/admin/login', 'LoginController@adminLogin')->name('admin.login');