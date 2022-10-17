<?php

use Illuminate\Support\Facades\Route;

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

/**
 * 前台
 */
Route::get('/', 'FrontstageController@index');

/**
 * 註冊與登入
 */
// Auth::routes();
Route::get('/login', 'Auth\LoginController@index')->name('Login_View');
Route::post('/login', 'Auth\LoginController@login')->name('Login');
Route::post('/logout', 'Auth\LoginController@logout')->name('Logout');

Route::get('/register', 'Auth\RegisterController@index')->name('Register_View');
Route::post('/register', 'Auth\RegisterController@register')->name('Register');
// Route::get('/email/verify', 'Auth\RegisterController@register')->name('RouteName');
// Route::post('/email/verify', 'Auth\RegisterController@register')->name('RouteName');

// Route::get('/password/forgot', 'Auth\PasswordController@index')->name('RouteName');
// Route::post('/password/forgot', 'Auth\PasswordController@forgot')->name('RouteName');
// Route::get('/password/reset', 'Auth\PasswordController@index')->name('RouteName');
// Route::post('/password/reset', 'Auth\PasswordController@reset')->name('RouteName');

/**
 * 後台
 */
Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {
    // 首頁
    Route::get('/', 'User\UserController@index')->name('UserHome_View');
});
