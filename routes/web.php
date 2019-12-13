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

Route::get('/home', 'HomeController@index')->name('home');

// return view('layout.template');
// });

Route::prefix('template')->name('template.')->group(function ()
{
	Route::get('/', 'templateController@index')->name('index');
	Route::get('/create', 'templateController@create')->name('create');
	Route::post('/store', 'templateController@store')->name('store');
	// Route::get('/template/{id}', 'templateController@show')->name('template.show');
	Route::get('/{id}/edit', 'templateController@edit')->name('edit');
	Route::put('/{id}/update', 'templateController@update')->name('update');
});

Route::prefix('akademik')->name('akademik.')->group(function (){
	// Route::redirect('/', '/akademik/dashboard');
	Route::get('/', 'akademikController@dashboard')->name('dashboard');

	//Route data skripsi
	Route::get('/data-skripsi', 'skripsiController@index')->name('data-skripsi.index');
	Route::get('/data-skripsi/{id_skripsi}/ubah-judul', 'skripsiController@ubahJudul')->name('data-skripsi.ubah-judul');
	Route::post('/data-skripsi/{id_skripsi}/ubah-judul/store', 'skripsiController@store_ubahJudul')->name('data-skripsi.ubah-judul.store');

	Route::get('/data-skripsi/{id_skripsi}/ubah-judul-pembimbing', 'skripsiController@ubahJudulPembimbing')->name('data-skripsi.ubah-judul-pembimbing');
	Route::post('/data-skripsi/{id_skripsi}/ubah-judul-pembimbing/store', 'skripsiController@store_ubahJudulPembimbing')->name('data-skripsi.ubah-judul-pembimbing.store');

	Route::get('data-skripsi/{id_skripsi}/update-judul', 'skripsiController@updateJudul')->name('data-skripsi.update-judul');
	Route::put('data-skripsi/{id_skripsi}/update-judul/update', 'skripsiController@update_updateJudul')->name('data-skripsi.update-judul.update');

	//Route Surat Tugas Pembimbing
	Route::get('/surat-tugas-pembimbing', 'sutgasPembimbingController@index')->name("sutgas-pembimbing.index");
	Route::get('/surat-tugas-pembimbing/create', 'sutgasPembimbingController@create')->name("sutgas-pembimbing.create");
	Route::post('/surat-tugas-pembimbing/store', 'sutgasPembimbingController@store')->name("sutgas-pembimbing.store");
	Route::get('/surat-tugas-pembimbing/{id}', 'sutgasPembimbingController@show')->name("sutgas-pembimbing.show");
   Route::get('/surat-tugas-pembimbing/{id}/edit', 'sutgasPembimbingController@edit')->name("sutgas-pembimbing.edit");
   Route::put('/surat-tugas-pembimbing/{id}/update', 'sutgasPembimbingController@update')->name("sutgas-pembimbing.update");
   Route::get('/surat-tugas-pembimbing/{id}/cetak', 'sutgasPembimbingController@cetak_pdf')->name("sutgas-pembimbing.cetak");

   Route::get('/getPembimbing/{nim?}', 'suratTugasController@getPembimbing')->name('getPembimbing');

   //Route Surat Tugas Pembahas
   Route::get('/surat-tugas-pembahas', 'sutgasPembahasController@index')->name("sutgas-pembahas.index");
   Route::get('/surat-tugas-pembahas/create', 'sutgasPembahasController@create')->name("sutgas-pembahas.create");
   Route::post('/surat-tugas-pembahas/store', 'sutgasPembahasController@store')->name("sutgas-pembahas.store");
   Route::get('/surat-tugas-pembahas/{id}', 'sutgasPembahasController@show')->name("sutgas-pembahas.show");
   Route::get('/surat-tugas-pembahas/{id}/edit', 'sutgasPembahasController@edit')->name("sutgas-pembahas.edit");
   Route::put('/surat-tugas-pembahas/{id}/update', 'sutgasPembahasController@update')->name("sutgas-pembahas.update");
   Route::get('/surat-tugas-pembahas/{id}/cetak', 'sutgasPembahasController@cetak_pdf')->name("sutgas-pembahas.cetak");

   //Route Surat Tugas Penguji
   Route::get('/surat-tugas-penguji', 'sutgasPengujiController@index')->name("sutgas-penguji.index");
   Route::get('/surat-tugas-penguji/create', 'sutgasPengujiController@create')->name("sutgas-penguji.create");
   Route::post('/surat-tugas-penguji/store', 'sutgasPengujiController@store')->name("sutgas-penguji.store");
   Route::get('/surat-tugas-penguji/{id}', 'sutgasPengujiController@show')->name("sutgas-penguji.show");
   Route::get('/surat-tugas-penguji/{id}/edit', 'sutgasPengujiController@edit')->name("sutgas-penguji.edit");
   Route::put('/surat-tugas-penguji/{id}/update', 'sutgasPengujiController@update')->name("sutgas-penguji.update");
   Route::get('/surat-tugas-penguji/{id}/cetak', 'sutgasPengujiController@cetak_pdf')->name("sutgas-penguji.cetak");

	//Route SK Sempro
	Route::get('/sk-sempro', 'SkSemproController@index')->name('sempro.index');
	Route::get('/sk-sempro/create', 'SkSemproController@create')->name('sempro.create');
	Route::post('/sk-sempro', 'SkSemproController@store')->name('sempro.store');
	Route::get('/sk-sempro/{id_sk}', 'SkSemproController@show')->name('sempro.show');
	Route::get('/sk-sempro/{id_sk}/edit', 'SkSemproController@edit')->name('sempro.edit');
	Route::put('/sk-sempro/{id_sk}/update', 'SkSemproController@update')->name('sempro.update');
	Route::delete('/sk-sempro/delete/{id_sk?}', 'SkSemproController@destroy')->name('sempro.destroy');
	Route::get('/sempro/{id_sk}/cetak', 'SKSemproController@cetak_pdf')->name("sempro.cetak");

	//Route SK Skripsi
	Route::get('/sk-skripsi', 'SkSkripsiController@index')->name('skripsi.index');
	Route::get('/sk-skripsi/create','SkSkripsiController@create')->name('skripsi.create');
	Route::post('/sk-skripsi', 'SkSkripsiController@store')->name('skripsi.store');
	Route::get('/sk-skripsi/{id_sk}', 'SkSkripsiController@show')->name('skripsi.show');
	Route::get('/sk-skripsi/{id_sk}/edit','SkSkripsiController@edit')->name('skripsi.edit');
	Route::put('/sk-skripsi/{id_sk}/update','SkSkripsiController@update')->name('skripsi.update');
	Route::get('/sk-skripsi/{id_sk_akademik}/cetak', 'SkSkripsiController@cetak')->name('skripsi.cetak');
	Route::delete('/sk-skripsi/delete/{id_sk?}', 'SkSkripsiController@destroy')->name('skripsi.destroy');

	//Route Template SK
	Route::get('/template-sk/', 'templateController@index_sk_akademik')->name('template-sk.index');
	Route::get('/template-sk/create', 'templateController@create_sk_akademik')->name('template-sk.create');
	Route::post('/template-sk/store', 'templateController@store_sk_akademik')->name('template-sk.store');
	Route::get('/template-sk/{id}', 'templateController@show_sk_akademik')->name('template-sk.show');
	Route::get('/template-sk/{id}/edit', 'templateController@edit_sk_akademik')->name('template-sk.edit');
	Route::put('/template-sk/{id}/update', 'templateController@update_sk_akademik')->name('template-sk.update');
});

Route::prefix('ktu')->name('ktu.')->group(function ()
{
	Route::get('/', function() {
	    return view('ktu.dashboard');
	});

	//Route Surat Tugas Pembimbing
	Route::get('/surat-tugas-pembimbing', 'sutgasPembimbingController@ktu_index')->name('sutgas-pembimbing.index');
	Route::get('/surat-tugas-pembimbing/{id}', 'sutgasPembimbingController@ktu_show')->name("sutgas-pembimbing.show");
	Route::put('/surat-tugas-pembimbing/verif/{id}', 'sutgasPembimbingController@ktu_verif')->name("sutgas-pembimbing.verif");

	//Route Surat Tugas Pembahas
	Route::get('/surat-tugas-pembahas', 'sutgasPembahasController@ktu_index')->name('sutgas-pembahas.index');
	Route::get('/surat-tugas-pembahas/{id}', 'sutgasPembahasController@ktu_show')->name("sutgas-pembahas.show");
	Route::put('/surat-tugas-pembahas/verif/{id}', 'sutgasPembahasController@ktu_verif')->name("sutgas-pembahas.verif");

	//Route Surat Tugas penguji
	Route::get('/surat-tugas-penguji', 'sutgasPengujiController@ktu_index')->name('sutgas-penguji.index');
	Route::get('/surat-tugas-penguji/{id}', 'sutgasPengujiController@ktu_show')->name("sutgas-penguji.show");
	Route::put('/surat-tugas-penguji/verif/{id}', 'sutgasPengujiController@ktu_verif')->name("sutgas-penguji.verif");

	//Route Surat SK Skripsi
	Route::get('/sk-skripsi', 'SkSkripsiController@ktu_index_skripsi')->name('sk-skripsi.index');
	Route::get('/sk-skripsi/{id_sk_akademik}', 'SkSkripsiController@ktu_show')->name('sk-skripsi.show');
	Route::put('/sk-skripsi/verif/{id_sk_akademik}', 'SkSkripsiController@ktu_verif')->name('sk-skripsi.verif');

	//Route Surat SK Sempro
	Route::get('/sk-sempro', 'SkSemproController@ktu_index_sempro')->name('sk-sempro.index');
	Route::get('/sk-sempro/{id_sk_akademik}', 'SkSemproController@ktu_show')->name('sk-sempro.show');
	Route::put('/sk-sempro/verif/{id_sk_akademik}', 'SkSemproController@ktu_verif')->name('sk-sempro.verif');

	Route::get('/honor-skripsi', 'honorSkripsiController@ktu_index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@ktu_show')->name('honor-skripsi.show');
	Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@ktu_verif')->name('honor-skripsi.verif');

	Route::get('/honor-sempro', 'honorSemproController@ktu_index')->name('honor-sempro.index');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@ktu_show')->name('honor-sempro.show');
	Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@ktu_verif')->name('honor-sempro.verif');
});

Route::prefix('dekan')->name('dekan.')->group(function()
{
	Route::get('/', function()
	{
		return view('dekan.dashboard');
	});
	Route::get('/sk-skripsi', 'SkSkripsiController@dekan_index_skripsi')->name('sk-skripsi.index');
	Route::get('/sk-skripsi/{id_sk_akademik}', 'SkSkripsiController@dekan_show')->name('sk-skripsi.show');
	Route::put('/sk-skripsi/verif/{id_sk_akademik}', 'SkSkripsiController@dekan_verif')->name('sk-skripsi.verif');

	Route::get('/sk-sempro', 'SkSemproController@dekan_index_sempro')->name('sk-sempro.index');
	Route::get('/sk-sempro/{id_sk_akademik}', 'SkSemproController@dekan_show')->name('sk-sempro.show');
	Route::put('/sk-sempro/verif/{id_sk_akademik}', 'SkSemproController@dekan_verif')->name('sk-sempro.verif');

	Route::get('/honor-skripsi', 'honorSkripsiController@dekan_index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@dekan_show')->name('honor-skripsi.show');
	Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@dekan_verif')->name('honor-skripsi.verif');

	Route::get('/honor-sempro', 'honorSemproController@dekan_index')->name('honor-sempro.index');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@dekan_show')->name('honor-sempro.show');
	Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@dekan_verif')->name('honor-sempro.verif');
});

Route::prefix('keuangan')->name('keuangan.')->group(function()
{
	Route::get('/', function() {
	    return view('keuangan.dashboard');
	});

	//Honor Skripsi
	Route::get('/honor-skripsi/', 'honorSkripsiController@index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/store/{id_sk_skripsi}', 'honorSkripsiController@store')->name('honor-skripsi.store');
	Route::get('/honor-skripsi/show/{id_sk_honor}','honorSkripsiController@show')->name('honor-skripsi.show');
	Route::delete('/honor-skripsi/delete/{id_sk_honor?}', 'honorSkripsiController@destroy')->name('honor-skripsi.destroy');
	Route::get('/honor-skripsi/show/{id_sk_honor}/cetak-pdf', 'honorSkripsiController@cetak_pdf')->name('honor-skripsi.cetak');
	Route::put('/honor-skripsi/{id_sk_honor}/status-dibayarkan', 'honorSemproController@status_dibayarkan')->name('honor-skripsi.status_dibayarkan');
    Route::get('/honor-skripsi/create/', 'honorSkripsiController@create')->name('honor-skripsi.create');
    	// Route::get('/honor-skripsi/pilih-sk', 'honorSkripsiController@pilih_sk')->name('honor-skripsi.pilih-sk');
	// Route::get('/honor-skripsi/show/{id_sk_honor}/edit','honorSkripsiController@edit')->name('honor-skripsi.edit');
	// Route::put('/honor-skripsi/show/{id_sk_honor}/update','honorSkripsiController@update')->name('honor-skripsi.update');

	//Honor Sempro
	Route::get('/honor-sempro/', 'honorSemproController@index')->name('honor-sempro.index');
	Route::get('/honor-sempro/store/{id_sk_sempro}', 'honorSemproController@store')->name('honor-sempro.store');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@show')->name('honor-sempro.show');
	Route::delete('/honor-sempro/delete/{id_sk_honor?}', 'honorSemproController@destroy')->name('honor-sempro.destroy');
	Route::get('/honor-sempro/{id_sk_honor}/cetak-pdf', 'honorSemproController@cetak_pdf')->name('honor-sempro.cetak');
	Route::put('/honor-sempro/{id_sk_honor}/status-dibayarkan', 'honorSemproController@status_dibayarkan')->name('honor-sempro.status_dibayarkan');
	// Route::get('/honor-sempro/pilih-sk', 'honorSemproController@pilih_sk')->name('honor-sempro.pilih-sk');
	// Route::get('/honor-sempro/create/{id_sk_sempro}', 'honorSemproController@create')->name('honor-sempro.create');
	// Route::get('/honor-sempro/{id_sk_honor}/edit', 'honorSemproController@edit')->name('honor-sempro.edit');
	// Route::put('/honor-sempro/{id_sk_honor}/update', 'honorSemproController@update')->name('honor-sempro.update');
});

Route::prefix('honor')->name('honor.')->group(function()
{
	Route::get('/', 'honorController@index')->name('index');
	Route::get('/create', 'honorController@create')->name('create');
	Route::post('/store', 'honorController@store')->name('store');
	Route::get('/{id}/edit', 'honorController@edit')->name('edit');
	Route::put('/{id}/update', 'honorController@update')->name('update');

});

Route::prefix('bpp')->name('bpp.')->group(function()
{
	Route::get('/', function() {
	    return view('bpp.dashboard');
	});

	//Route Honor Sempro
	Route::get('/honor-sempro', 'honorSemproController@bpp_index')->name('honor-sempro.index');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@bpp_show')->name('honor-sempro.show');
	Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@bpp_verif')->name('honor-sempro.verif');

	//Route Honor Skripsi
	Route::get('/honor-skripsi', 'honorSkripsiController@bpp_index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@bpp_show')->name('honor-skripsi.show');
	Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@bpp_verif')->name('honor-skripsi.verif');

});

Route::prefix('wadek2')->name('wadek2.')->group(function()
{
	Route::get('/', function() {
	    return view('wadek2.dashboard');
	});
	Route::get('/honor-skripsi', 'honorSkripsiController@wadek2_index')->name('honor-skripsi.index');
	Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@wadek2_show')->name('honor-skripsi.show');
	Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@wadek2_verif')->name('honor-skripsi.verif');

	Route::get('/honor-sempro', 'honorSemproController@wadek2_index')->name('honor-sempro.index');
	Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@wadek2_show')->name('honor-sempro.show');
	Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@wadek2_verif')->name('honor-sempro.verif');
});
