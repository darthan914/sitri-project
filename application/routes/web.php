<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'Admin\AuthController@loginForm')->name('admin.loginForm');
Route::post('/login', 'Admin\AuthController@login')->name('admin.login');
Route::get('/register', 'Admin\AuthController@registerForm')->name('admin.registerForm');
Route::post('/register', 'Admin\AuthController@register')->name('admin.register');
Route::get('/logout', 'Admin\AuthController@logout')->name('admin.logout');
Route::get('/forgotPassword', 'Admin\AuthController@forgotPasswordForm')->name('admin.forgotPasswordForm');
Route::post('/forgotPassword', 'Admin\AuthController@forgotPassword')->name('admin.forgotPassword');
Route::get('/resetPassword', 'Admin\AuthController@resetPasswordForm')->name('admin.resetPasswordForm');
Route::post('/resetPassword', 'Admin\AuthController@resetPassword')->name('admin.resetPassword');
Route::get('/verify', 'Admin\AuthController@verify')->name('admin.verify');
