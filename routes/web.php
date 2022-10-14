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
 * 後台
 */
Auth::routes();

Route::get('/login', 'Auth\LoginController@index')->name('Login_View');
Route::post('/login', 'Auth\LoginController@index')->name('Login');
Route::post('/logout', 'Auth\LoginController@index')->name('Logout');

// Route::get('/register', 'Auth\RegisterController@index')->name('Register_View');
// Route::post('/register', 'Auth\RegisterController@register')->name('Register');
Route::get('/home', 'UserController@index')->name('home');
