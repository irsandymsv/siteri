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
	Route::put('/skripsi/{id_sk_akademik}/update','SkSkripsiController@update')->name('skripsi.update');
	Route::delete('/skripsi/delete/{id_sk_akademik?}', 'SkSkripsiController@destroy')->name('skripsi.destroy');

	Route::get('/sempro', 'SkSkripsiController@index')->name('sempro.index');
	Route::get('/sempro/create', 'SkSkripsiController@create')->name('sempro.create');
	Route::post('/sempro', 'SkSkripsiController@store')->name('sempro.store');
	Route::get('/sempro/{id_sk_akademik}', 'SkSkripsiController@show')->name('sempro.show');
	Route::get('/sempro/{id_sk_akademik}/edit', 'SkSkripsiController@edit')->name('sempro.edit');
	Route::put('/sempro/{id_sk_akademik}/update', 'SkSkripsiController@update')->name('sempro.update');
	Route::delete('/sempro/delete/{id_sk_akademik?}', 'SkSkripsiController@destroy')->name('sempro.destroy');
});
