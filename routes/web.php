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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/diposit', 'HomeController@diposit')->name('diposit');
Route::get('/withdrawal', 'HomeController@withdrawal')->name('withdrawal');
Route::get('/user-withdrawal', 'HomeController@userWithdrawal')->name('user-withdrawal');
Route::get('/register', 'Auth\CustomRegisterController@showRegistrationForm')->name('register');
Route::post('register-save', 'Auth\CustomRegisterController@save')->name('register-save');;
Route::post('withdrawal-save', 'HomeController@saveWithdrawal')->name('withdrawal-save');
Route::get('/user-diposit', 'HomeController@userDiposit')->name('user-diposit');
Route::post('/diposit-save', 'HomeController@saveDiposit')->name('diposit-save');
