<?php

use Illuminate\Support\Facades\Route;

Route::prefix('home')->name('home.')->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
})
;

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('dataTable', 'UserController@dataTable')->name('dataTable');
    Route::get('create', 'UserController@create')->name('create');
    Route::post('store', 'UserController@store')->name('store');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::post('{user}/update', 'UserController@update')->name('update');
    Route::post('{user}/delete', 'UserController@delete')->name('delete');
    Route::post('{user}/active', 'UserController@active')->name('active');
    Route::get('getUserByEmail', 'UserController@getUserByEmail')->name('getUserByEmail');
})
;

Route::prefix('student')->name('student.')->group(function () {
    Route::get('/', 'StudentController@index')->name('index');
    Route::get('dataTable', 'StudentController@dataTable')->name('dataTable');
    Route::get('create', 'StudentController@create')->name('create');
    Route::post('store', 'StudentController@store')->name('store');
    Route::get('{student}/view', 'StudentController@view')->name('view');
    Route::get('{student}/edit', 'StudentController@edit')->name('edit');
    Route::post('{student}/update', 'StudentController@update')->name('update');
    Route::post('{student}/delete', 'StudentController@delete')->name('delete');
    Route::post('deleteMultiple', 'StudentController@deleteMultiple')->name('deleteMultiple');
})
;

Route::prefix('schedule')->name('schedule.')->group(function () {
    Route::get('/', 'ScheduleController@index')->name('index');
    Route::get('dataTable', 'ScheduleController@dataTable')->name('dataTable');
    Route::get('create', 'ScheduleController@create')->name('create');
    Route::post('store', 'ScheduleController@store')->name('store');
    Route::get('{schedule}/edit', 'ScheduleController@edit')->name('edit');
    Route::post('{schedule}/update', 'ScheduleController@update')->name('update');
    Route::post('{schedule}/delete', 'ScheduleController@delete')->name('delete');
    Route::post('{schedule}/active', 'ScheduleController@active')->name('active');
})
;

Route::prefix('classRoom')->name('classRoom.')->group(function () {
    Route::get('/', 'ClassRoomController@index')->name('index');
    Route::get('dataTable', 'ClassRoomController@dataTable')->name('dataTable');
    Route::get('create', 'ClassRoomController@create')->name('create');
    Route::post('store', 'ClassRoomController@store')->name('store');
    Route::get('{classRoom}/edit', 'ClassRoomController@edit')->name('edit');
    Route::post('{classRoom}/update', 'ClassRoomController@update')->name('update');
    Route::post('{classRoom}/delete', 'ClassRoomController@delete')->name('delete');
    Route::post('{classRoom}/active', 'ClassRoomController@active')->name('active');
})
;

Route::prefix('classSchedule')->name('classSchedule.')->group(function () {
    Route::get('/', 'ClassScheduleController@index')->name('index');
    Route::get('dataTable', 'ClassScheduleController@dataTable')->name('dataTable');
    Route::get('create', 'ClassScheduleController@create')->name('create');
    Route::post('store', 'ClassScheduleController@store')->name('store');
    Route::get('{classSchedule}/edit', 'ClassScheduleController@edit')->name('edit');
    Route::post('{classSchedule}/update', 'ClassScheduleController@update')->name('update');
    Route::post('{classSchedule}/delete', 'ClassScheduleController@delete')->name('delete');
    Route::post('{classSchedule}/active', 'ClassScheduleController@active')->name('active');
    Route::get('getTimeByDay', 'ClassScheduleController@getTimeByDay')->name('getTimeByDay');
})
;

Route::prefix('classStudent')->name('classStudent.')->group(function () {
    Route::get('/', 'ClassStudentController@index')->name('index');
    Route::get('dataTable', 'ClassStudentController@dataTable')->name('dataTable');
    Route::get('create', 'ClassStudentController@create')->name('create');
    Route::post('store', 'ClassStudentController@store')->name('store');
    Route::get('{classStudent}/edit', 'ClassStudentController@edit')->name('edit');
    Route::post('{classStudent}/update', 'ClassStudentController@update')->name('update');
    Route::post('{classStudent}/delete', 'ClassStudentController@delete')->name('delete');
})
;

Route::prefix('reschedule')->name('reschedule.')->group(function () {
    Route::get('/', 'RescheduleController@index')->name('index');
    Route::get('dataTable', 'RescheduleController@dataTable')->name('dataTable');
    Route::get('create', 'RescheduleController@create')->name('create');
    Route::post('store', 'RescheduleController@store')->name('store');
    Route::get('{reschedule}/edit', 'RescheduleController@edit')->name('edit');
    Route::post('{reschedule}/update', 'RescheduleController@update')->name('update');
    Route::post('{reschedule}/delete', 'RescheduleController@delete')->name('delete');
    Route::get('getRegularStudent', 'RescheduleController@getRegularStudent')->name('getRegularStudent');
    Route::get('getScheduleAvailable', 'RescheduleController@getScheduleAvailable')->name('getScheduleAvailable');
})
;

Route::prefix('absence')->name('absence.')->group(function () {
    Route::get('/', 'AbsenceController@index')->name('index');
    Route::get('dataTable', 'AbsenceController@dataTable')->name('dataTable');
    Route::get('create', 'AbsenceController@create')->name('create');
    Route::post('store', 'AbsenceController@store')->name('store');
    Route::get('{absence}/edit', 'AbsenceController@edit')->name('edit');
    Route::post('{absence}/update', 'AbsenceController@update')->name('update');
    Route::post('{absence}/delete', 'AbsenceController@delete')->name('delete');
    Route::get('getScheduleDate', 'AbsenceController@getScheduleDate')->name('getScheduleDate');
    Route::get('getStudentList', 'AbsenceController@getStudentList')->name('getStudentList');
})
;

Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/', 'PaymentController@index')->name('index');
    Route::get('dataTable', 'PaymentController@dataTable')->name('dataTable');
    Route::get('create', 'PaymentController@create')->name('create');
    Route::post('store', 'PaymentController@store')->name('store');
    Route::get('{payment}/edit', 'PaymentController@edit')->name('edit');
    Route::post('{payment}/update', 'PaymentController@update')->name('update');
    Route::post('{payment}/delete', 'PaymentController@delete')->name('delete');
    Route::post('{payment}/paid', 'PaymentController@paid')->name('paid');
})
;

Route::prefix('trial')->name('trial.')->group(function () {
    Route::get('/', 'TrialController@index')->name('index');
    Route::get('dataTable', 'TrialController@dataTable')->name('dataTable');
    Route::get('create', 'TrialController@create')->name('create');
    Route::post('store', 'TrialController@store')->name('store');
    Route::get('{student}/edit', 'TrialController@edit')->name('edit');
    Route::post('{student}/update', 'TrialController@update')->name('update');
    Route::post('{student}/delete', 'TrialController@delete')->name('delete');
})
;
