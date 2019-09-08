<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('dataTable', 'UserController@dataTable')->name('dataTable');
    Route::get('create', 'UserController@create')->name('create');
    Route::post('store', 'UserController@store')->name('store');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::post('{user}/update', 'UserController@update')->name('update');
    Route::post('{user}/delete', 'UserController@delete')->name('delete');
    Route::post('{user}/active', 'UserController@active')->name('active');
})
;

Route::prefix('student')->name('student.')->group(function () {
    Route::get('/', 'StudentController@index')->name('index');
    Route::get('dataTable', 'StudentController@dataTable')->name('dataTable');
    Route::get('create', 'StudentController@create')->name('create');
    Route::post('store', 'StudentController@store')->name('store');
    Route::get('{student}/edit', 'StudentController@edit')->name('edit');
    Route::post('{student}/update', 'StudentController@update')->name('update');
    Route::post('{student}/delete', 'StudentController@delete')->name('delete');
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
})
;
