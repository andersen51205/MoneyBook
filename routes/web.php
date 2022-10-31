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
    // 帳戶管理
    Route::get('/accountManagement', 'User\UserController@account')->name('Account_View');
    // 類別管理
    Route::get('/categoryManagement', 'User\UserController@category')->name('Category_View');
});

/**
 * 後台API
 */
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {
    // 帳戶
    Route::get('/accounts', 'User\AccountController@index')->name('Account_List');
    Route::post('/accounts', 'User\AccountController@store')->name('Create_Account');
    Route::put('/accounts/{id}', 'User\AccountController@update')->name('Update_Account');
    Route::delete('/accounts/{id}', 'User\AccountController@destroy')->name('Delete_Account');
    // 類別
    Route::get('/categories', 'User\CategoryController@index')->name('Category_List');
    Route::post('/categories', 'User\CategoryController@store')->name('Create_Category');
    Route::delete('/categories/{id}', 'User\CategoryController@destroy')->name('Delete_Category');
});
