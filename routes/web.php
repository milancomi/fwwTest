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
})->name('welcome');


Route::get('/home', 'HomeController@index')->name('home');



Route::get('/fetch_data','CalendarController@fetchData');

Route::post('/postEvent','CalendarController@addEvent')->name('addEvent');
Route::post('/deleteEvent','CalendarController@deleteEvent')->name('deleteEvent');
Route::post('/updateEvent','CalendarController@updateEvent')->name('updateEvent');




Route::post('/register','Auth\RegisterController@registerUser')->name('registerUser');


Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/loginForm','Auth\RegisterController@showLoginForm')->name('login');

Route::get('/calendar','HomeController@index')->name('calendar');



