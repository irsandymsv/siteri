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

Route::prefix('akademik')->name('akademik.')->group(function (){
	Route::redirect('/', '/akademik/dashboard');
	Route::get('/dashboard', 'akademikController@dashboard')->name('dashboard');

	Route::get('/skripsi', 'SkSkripsiController@index')->name('skripsi.index');
	Route::get('/skripsi/create','SkSkripsiController@create')->name('skripsi.create');
	Route::post('/skripsi', 'SkSkripsiController@store')->name('skripsi.store');
	Route::get('/skripsi/{id_sk_akademik}', 'SkSkripsiController@show')->name('skripsi.show');
	Route::get('/skripsi/{id_sk_akademik}/edit','SkSkripsiController@edit')->name('skripsi.edit');
});
