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
