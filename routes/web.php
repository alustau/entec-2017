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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home')
    ->middleware('auth');

Route::get('/users', 'UserController@index')->name('users')->middleware('auth');

Route::get('/doctors', 'DoctorController@index')->name('doctors.index')->middleware('auth');
Route::get('/doctor/create', 'DoctorController@create')->name('doctor.create')->middleware('auth');
Route::post('/doctor', 'DoctorController@store')->name('doctor.save')->middleware('auth');
Route::post('/doctor/{doctor}/edit', 'DoctorController@edit')->name('doctors.edit')->middleware('auth');
Route::delete('/doctor/{doctor}', 'DoctorController@delete')->name('doctors.delete')->middleware('auth');
