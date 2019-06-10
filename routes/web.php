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


//Doctor Search
Route::get('/search/view', 'SearchController@index');
Route::get('/doctors/list', 'DoctorsController@get_all_doctors');
Route::get('/doctor/{id}/profile', 'DoctorsController@profile')->name('doctor.profile');
Route::post('/doctors/search', 'SearchController@search_doctors');

//User Authentication
Auth::routes();

//Dashboard
Route::get('/admin', 'AdminController@index')->name('dashboard');

//Doctors
Route::get('/doctors/all_doctors', 'AdminController@list_doctors')->name('doctors.list');
Route::get('/doctor/add', 'AdminController@add')->name('doctor.add');
Route::post('/doctor/create', 'AdminController@create')->name('doctor.create');
Route::delete('/doctor/delete/{id}', 'AdminController@delete')->name('doctor.delete');
Route::get('/doctor/edit/{id}', 'AdminController@edit')->name('doctor.edit');
Route::put('/doctor/update/{id}', 'AdminController@update')->name('doctor.update');
