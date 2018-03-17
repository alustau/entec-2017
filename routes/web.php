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

Route::middleware(['auth', 'remove-token'])->group(function() {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/users', 'UserController@index')->name('users');

    Route::get('/doctors', 'DoctorController@index')
        ->name('doctors.index');

    Route::get('/doctor/create', 'DoctorController@create')
        ->name('doctor.create');

    Route::post('/doctor', 'DoctorController@store')
        ->name('doctor.save');

    Route::get('/doctor/{doctor}/edit', 'DoctorController@edit')
        ->name('doctor.edit');

    Route::post('/doctor/{doctor}/update', 'DoctorController@update')
        ->name('doctor.update');

    Route::get('/doctor/{doctor}/delete', 'DoctorController@delete')
        ->name('doctor.delete');

    Route::get('/doctor/{doctor}/appointments', 'DoctorController@appointments')
        ->name('doctor.appointments');

    Route::get('/appointments', 'AppointmentController@index')
        ->name('appointments.index');

    Route::get('/appointment/create', 'AppointmentController@create')
        ->name('appointment.create');

    Route::post('/appointment', 'AppointmentController@store')
        ->name('appointment.save');

    Route::get('/appointment/{appointment}/delete', 'AppointmentController@delete')
        ->name('appointment.delete');
});

