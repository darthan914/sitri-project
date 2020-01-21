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
    Route::get('{id}/edit', 'UserController@edit')->name('edit');
    Route::post('{id}/update', 'UserController@update')->name('update');
    Route::post('{id}/delete', 'UserController@delete')->name('delete');
    Route::post('{id}/active', 'UserController@active')->name('active');
    Route::get('getUserByEmail', 'UserController@getUserByEmail')->name('getUserByEmail');
})
;

Route::prefix('student')->name('student.')->group(function () {
    Route::get('/', 'StudentController@index')->name('index');
    Route::get('dataTable', 'StudentController@dataTable')->name('dataTable');
    Route::get('create', 'StudentController@create')->name('create');
    Route::post('store', 'StudentController@store')->name('store');
    Route::get('{id}/view', 'StudentController@view')->name('view');
    Route::get('{id}/edit', 'StudentController@edit')->name('edit');
    Route::post('{id}/update', 'StudentController@update')->name('update');
    Route::post('{id}/delete', 'StudentController@delete')->name('delete');
    Route::post('deleteMultiple', 'StudentController@deleteMultiple')->name('deleteMultiple');
})
;

Route::prefix('schedule')->name('schedule.')->group(function () {
    Route::get('/', 'ScheduleController@index')->name('index');
    Route::get('dataTable', 'ScheduleController@dataTable')->name('dataTable');
    Route::get('create', 'ScheduleController@create')->name('create');
    Route::post('store', 'ScheduleController@store')->name('store');
    Route::get('{id}/edit', 'ScheduleController@edit')->name('edit');
    Route::post('{id}/update', 'ScheduleController@update')->name('update');
    Route::post('{id}/delete', 'ScheduleController@delete')->name('delete');
    Route::post('{id}/active', 'ScheduleController@active')->name('active');
})
;

Route::prefix('classRoom')->name('classRoom.')->group(function () {
    Route::get('/', 'ClassRoomController@index')->name('index');
    Route::get('dataTable', 'ClassRoomController@dataTable')->name('dataTable');
    Route::get('create', 'ClassRoomController@create')->name('create');
    Route::post('store', 'ClassRoomController@store')->name('store');
    Route::get('{id}/edit', 'ClassRoomController@edit')->name('edit');
    Route::post('{id}/update', 'ClassRoomController@update')->name('update');
    Route::post('{id}/delete', 'ClassRoomController@delete')->name('delete');
    Route::post('{id}/active', 'ClassRoomController@active')->name('active');
})
;

Route::prefix('classSchedule')->name('classSchedule.')->group(function () {
    Route::get('/', 'ClassScheduleController@index')->name('index');
    Route::get('dataTable', 'ClassScheduleController@dataTable')->name('dataTable');
    Route::get('create', 'ClassScheduleController@create')->name('create');
    Route::post('store', 'ClassScheduleController@store')->name('store');
    Route::get('{id}/edit', 'ClassScheduleController@edit')->name('edit');
    Route::post('{id}/update', 'ClassScheduleController@update')->name('update');
    Route::post('{id}/delete', 'ClassScheduleController@delete')->name('delete');
    Route::post('{id}/active', 'ClassScheduleController@active')->name('active');
    Route::post('{id}/trial', 'ClassScheduleController@trial')->name('trial');
    Route::get('getTimeByDay', 'ClassScheduleController@getTimeByDay')->name('getTimeByDay');
})
;

Route::prefix('classStudent')->name('classStudent.')->group(function () {
    Route::get('/', 'ClassStudentController@index')->name('index');
    Route::get('dataTable', 'ClassStudentController@dataTable')->name('dataTable');
    Route::get('create', 'ClassStudentController@create')->name('create');
    Route::post('store', 'ClassStudentController@store')->name('store');
    Route::get('{id}/edit', 'ClassStudentController@edit')->name('edit');
    Route::post('{id}/update', 'ClassStudentController@update')->name('update');
    Route::post('{id}/delete', 'ClassStudentController@delete')->name('delete');
})
;

Route::prefix('reschedule')->name('reschedule.')->group(function () {
    Route::get('/', 'RescheduleController@index')->name('index');
    Route::get('dataTable', 'RescheduleController@dataTable')->name('dataTable');
    Route::get('create', 'RescheduleController@create')->name('create');
    Route::post('store', 'RescheduleController@store')->name('store');
    Route::get('{id}/edit', 'RescheduleController@edit')->name('edit');
    Route::post('{id}/update', 'RescheduleController@update')->name('update');
    Route::post('{id}/delete', 'RescheduleController@delete')->name('delete');
    Route::get('getRegularStudent', 'RescheduleController@getRegularStudent')->name('getRegularStudent');
    Route::get('getScheduleAvailable', 'RescheduleController@getScheduleAvailable')->name('getScheduleAvailable');
    Route::get('getDayAvailable', 'RescheduleController@getDayAvailable')->name('getDayAvailable');
})
;

Route::prefix('absence')->name('absence.')->group(function () {
    Route::get('/', 'AbsenceController@index')->name('index');
    Route::get('dataTable', 'AbsenceController@dataTable')->name('dataTable');
    Route::get('create', 'AbsenceController@create')->name('create');
    Route::post('store', 'AbsenceController@store')->name('store');
    Route::get('{id}/edit', 'AbsenceController@edit')->name('edit');
    Route::post('{id}/update', 'AbsenceController@update')->name('update');
    Route::post('{id}/delete', 'AbsenceController@delete')->name('delete');
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
    Route::get('{id}/edit', 'TrialController@edit')->name('edit');
    Route::post('{id}/update', 'TrialController@update')->name('update');
    Route::post('{id}/delete', 'TrialController@delete')->name('delete');
})
;

Route::prefix('item')->name('item.')->group(function () {
    Route::get('/', 'ItemController@index')->name('index');
    Route::get('dataTable', 'ItemController@dataTable')->name('dataTable');
    Route::get('create', 'ItemController@create')->name('create');
    Route::post('store', 'ItemController@store')->name('store');
    Route::get('{id}/edit', 'ItemController@edit')->name('edit');
    Route::post('{id}/update', 'ItemController@update')->name('update');
    Route::post('{id}/delete', 'ItemController@delete')->name('delete');
})
;

Route::prefix('setting')->name('setting.')->group(function () {
    Route::get('cost', 'SettingController@cost')->name('cost');
    Route::post('cost', 'SettingController@updateCost')->name('cost');
})
;
