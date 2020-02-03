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

Route::get(
    '/', function () {
        // return view('welcome');
        return redirect()->route('login');
    }
);

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// return view('layout.template');
// });

Route::middleware(['auth'])->prefix('notifikasi')->name('notifikasi.')->group(
    function () {
        Route::get('/', 'NotificationController@index')->name('index');
        Route::get('/read/{id}', 'NotificationController@read')->name('read');
        Route::get('/readAll', 'NotificationController@readAll')->name('readAll');
        // Route::get('/load', 'NotificationController@load')->name('load');
    }
);

// Route::get('/notifikasi/load', 'NotificationController@load')->name('notifikasi.icon');
Route::get('/notifikasi/load', 'NotificationController@load')->name('notifikasi.load');

Route::middleware(['auth', 'checkRole:Pengelola Data Akademik'])->prefix('template')->name('template.')->group(
    function () {
        Route::get('/', 'templateController@index')->name('index');
        Route::get('/create', 'templateController@create')->name('create');
        Route::post('/store', 'templateController@store')->name('store');
        // Route::get('/template/{id}', 'templateController@show')->name('template.show');
        Route::get('/{id}/edit', 'templateController@edit')->name('edit');
        Route::put('/{id}/update', 'templateController@update')->name('update');
    }
);

Route::middleware(['auth', 'checkRole:Pengelola Data Akademik'])->prefix('akademik')->name('akademik.')->group(
    function () {
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

        //edit status skripsi
        Route::get('data-skripsi/{id_skripsi}/edit-status', 'skripsiController@editStatus')->name('data-skripsi.edit-status');
        Route::put('data-skripsi/{id_skripsi}/update-status', 'skripsiController@updateStatus')->name('data-skripsi.edit-status.update');

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
        Route::get('/sk-skripsi/create', 'SkSkripsiController@create')->name('skripsi.create');
        Route::post('/sk-skripsi', 'SkSkripsiController@store')->name('skripsi.store');
        Route::get('/sk-skripsi/{id_sk}', 'SkSkripsiController@show')->name('skripsi.show');
        Route::get('/sk-skripsi/{id_sk}/edit', 'SkSkripsiController@edit')->name('skripsi.edit');
        Route::put('/sk-skripsi/{id_sk}/update', 'SkSkripsiController@update')->name('skripsi.update');
        Route::get('/sk-skripsi/{id_sk_akademik}/cetak', 'SkSkripsiController@cetak')->name('skripsi.cetak');
        Route::delete('/sk-skripsi/delete/{id_sk?}', 'SkSkripsiController@destroy')->name('skripsi.destroy');

        //Route Template SK
        Route::get('/template-sk/', 'templateController@index_sk_akademik')->name('template-sk.index');
        Route::get('/template-sk/create', 'templateController@create_sk_akademik')->name('template-sk.create');
        Route::post('/template-sk/store', 'templateController@store_sk_akademik')->name('template-sk.store');
        Route::get('/template-sk/{id}', 'templateController@show_sk_akademik')->name('template-sk.show');
        Route::get('/template-sk/{id}/edit', 'templateController@edit_sk_akademik')->name('template-sk.edit');
        Route::put('/template-sk/{id}/update', 'templateController@update_sk_akademik')->name('template-sk.update');
    }
);

Route::middleware(['auth', 'checkRole:KTU'])->prefix('ktu')->name('ktu.')->group(
    function () {
        Route::get('/', 'KTUController@dashboard')->name('dashboard');

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

        //Route SK Sempro
        Route::get('/sk-sempro', 'SkSemproController@ktu_index')->name('sk-sempro.index');
        Route::get('/sk-sempro/{id_sk_sempro}', 'SkSemproController@ktu_show')->name('sk-sempro.show');
        Route::put('/sk-sempro/verif/{id_sk_sempro}', 'SkSemproController@ktu_verif')->name('sk-sempro.verif');

        //Route SK Skripsi
        Route::get('/sk-skripsi', 'SkSkripsiController@ktu_index')->name('sk-skripsi.index');
        Route::get('/sk-skripsi/{id_sk_skripsi}', 'SkSkripsiController@ktu_show')->name('sk-skripsi.show');
        Route::put('/sk-skripsi/verif/{id_sk_skripsi}', 'SkSkripsiController@ktu_verif')->name('sk-skripsi.verif');

        //Route Honor Sempro
        Route::get('/honor-sempro', 'honorSemproController@ktu_index')->name('honor-sempro.index');
        Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@ktu_show')->name('honor-sempro.show');
        Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@ktu_verif')->name('honor-sempro.verif');

        //Route Honor Skripsi
        Route::get('/honor-skripsi', 'honorSkripsiController@ktu_index')->name('honor-skripsi.index');
        Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@ktu_show')->name('honor-skripsi.show');
        Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@ktu_verif')->name('honor-skripsi.verif');

        //Peminjaman
        Route::resource(
            'peminjaman_barang', 'peminjamanBarangController', [
            'only' => ['index', 'show']
            ]
        );
        Route::put('/peminjaman_barang/verif/{verif_ktu}', 'peminjamanBarangController@verif_ktu')->name('peminjaman_barang.verif');

        Route::resource(
            'peminjaman_ruang', 'peminjamanRuangController', [
            'only' => ['index', 'show']
            ]
        );
        Route::put('/peminjaman_ruang/verif/{verif_ktu}', 'peminjamanRuangController@verif_ktu')->name('peminjaman_ruang.verif');

        //Kepegawaian
        Route::get('/memu', 'kepegawaianController@ktu_memu')->name('memu.index');
        Route::get('/memu/{id}/approve', 'kepegawaianController@ktu_approve')->name('memu.approve');
        Route::get('/surat_tugas', 'kepegawaianController@ktu_surat')->name('surat.index');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@ktu_preview')->name('surat.preview');
        Route::get('/surat_tugas/{id}/cetak', 'kepegawaianController@cetakSurat')->name('surat.cetak');
        Route::get('/surat_tugas/{id}/approve', 'kepegawaianController@ktu_surat_approve')->name('surat.approve');
        Route::put('/surat_tugas/{id}/reject', 'kepegawaianController@ktu_surat_reject')->name('surat.reject');
        Route::get('/surat_tugas/{id}/alasan', 'kepegawaianController@reject_view')->name('surat.reject.view');
        Route::get('/surat_tugas/read', 'kepegawaianController@read_ktu')->name('surat.read');
        Route::get('/ganti_password', 'manageUserController@ktu_ganti_password')->name('ganti.password');
        Route::resource(
            'peminjaman_barang', 'peminjamanBarangController', [
            'only' => ['index', 'show']
            ]
        );
           Route::put('/peminjaman_barang/verif/{verif_ktu}', 'peminjamanBarangController@verif_ktu')->name('peminjaman_barang.verif');

        Route::resource(
            'peminjaman_ruang', 'peminjamanRuangController', [
                'only' => ['index', 'show']
                ]
        );
           Route::put('/peminjaman_ruang/verif/{verif_ktu}', 'peminjamanRuangController@verif_ktu')->name('peminjaman_ruang.verif');
    }
);

Route::middleware(['auth', 'checkRole:Dekan'])->prefix('dekan')->name('dekan.')->group(
    function () {
        Route::get('/', 'dekanController@dashboard')->name('dashboard');

        //Route SK Sempro
        Route::get('/sk-sempro', 'SkSemproController@dekan_index')->name('sk-sempro.index');
        Route::get('/sk-sempro/{id_sk_sempro}', 'SkSemproController@dekan_show')->name('sk-sempro.show');
        Route::put('/sk-sempro/verif/{id_sk_sempro}', 'SkSemproController@dekan_verif')->name('sk-sempro.verif');

        //Route SK Skripsi
        Route::get('/sk-skripsi', 'SkSkripsiController@dekan_index')->name('sk-skripsi.index');
        Route::get('/sk-skripsi/{id_sk_skripsi}', 'SkSkripsiController@dekan_show')->name('sk-skripsi.show');
        Route::put('/sk-skripsi/verif/{id_sk_skripsi}', 'SkSkripsiController@dekan_verif')->name('sk-skripsi.verif');

        //Route Honor Sempro
        Route::get('/honor-sempro', 'honorSemproController@dekan_index')->name('honor-sempro.index');
        Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@dekan_show')->name('honor-sempro.show');
        Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@dekan_verif')->name('honor-sempro.verif');

        //Route Honor Skripsi
        Route::get('/honor-skripsi', 'honorSkripsiController@dekan_index')->name('honor-skripsi.index');
        Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@dekan_show')->name('honor-skripsi.show');
        Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@dekan_verif')->name('honor-skripsi.verif');

        //Mahasiswa Bimbingan
        Route::get('/pembimbing-skripsi', 'dosenController@index_pembimbing')->name('pembimbing-skripsi');
        Route::get('/pembimbing-skripsi/{nim}', 'dosenController@show_pembimbing')->name('pembimbing-skripsi.show');

        //Mahasiswa Ujian Sempro
        Route::get('/pembahas-sempro', 'dosenController@index_pembahas')->name('pembahas-sempro');
        Route::get('/pembahas-sempro/{nim}', 'dosenController@show_pembahas')->name('pembahas-sempro.show');

        //Mahasiswa Ujian Skripsi
        Route::get('/penguji-skripsi', 'dosenController@index_penguji')->name('penguji-skripsi');
        Route::get('/penguji-skripsi/{nim}', 'dosenController@show_penguji')->name('penguji-skripsi.show');
    }
);

Route::middleware(['auth', 'checkRole:Penata Dokumen Keuangan'])->prefix('keuangan')->name('keuangan.')->group(
    function () {
        Route::get('/', 'KeuanganController@dashboard')->name('dashboard');

        //Honor Skripsi
        Route::get('/honor-skripsi/', 'honorSkripsiController@index')->name('honor-skripsi.index');
        Route::get('/honor-skripsi/store/{id_sk_skripsi}', 'honorSkripsiController@store')->name('honor-skripsi.store');
        Route::get('/honor-skripsi/show/{id_sk_honor}', 'honorSkripsiController@show')->name('honor-skripsi.show');
        Route::get('/honor-skripsi/show/{id_sk_honor}/cetak-pdf', 'honorSkripsiController@cetak_pdf')->name('honor-skripsi.cetak');
        Route::put('/honor-skripsi/{id_sk_honor}/status-dibayarkan', 'honorSkripsiController@status_dibayarkan')->name('honor-skripsi.status_dibayarkan');
        Route::get('/honor-skripsi/create/', 'honorSkripsiController@create')->name('honor-skripsi.create');
        // Route::delete('/honor-skripsi/delete/{id_sk_honor?}', 'honorSkripsiController@destroy')->name('honor-skripsi.destroy');
        // Route::get('/honor-skripsi/pilih-sk', 'honorSkripsiController@pilih_sk')->name('honor-skripsi.pilih-sk');
        // Route::get('/honor-skripsi/show/{id_sk_honor}/edit','honorSkripsiController@edit')->name('honor-skripsi.edit');
        // Route::put('/honor-skripsi/show/{id_sk_honor}/update','honorSkripsiController@update')->name('honor-skripsi.update');

        //Honor Sempro
        Route::get('/honor-sempro/', 'honorSemproController@index')->name('honor-sempro.index');
        Route::get('/honor-sempro/store/{id_sk_sempro}', 'honorSemproController@store')->name('honor-sempro.store');
        Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@show')->name('honor-sempro.show');
        Route::get('/honor-sempro/{id_sk_honor}/cetak-pdf', 'honorSemproController@cetak_pdf')->name('honor-sempro.cetak');
        Route::put('/honor-sempro/{id_sk_honor}/status-dibayarkan', 'honorSemproController@status_dibayarkan')->name('honor-sempro.status_dibayarkan');
        // Route::delete('/honor-sempro/delete/{id_sk_honor?}', 'honorSemproController@destroy')->name('honor-sempro.destroy');
        // Route::get('/honor-sempro/pilih-sk', 'honorSemproController@pilih_sk')->name('honor-sempro.pilih-sk');
        // Route::get('/honor-sempro/create/{id_sk_sempro}', 'honorSemproController@create')->name('honor-sempro.create');
        // Route::get('/honor-sempro/{id_sk_honor}/edit', 'honorSemproController@edit')->name('honor-sempro.edit');
        // Route::put('/honor-sempro/{id_sk_honor}/update', 'honorSemproController@update')->name('honor-sempro.update');
    }
);

Route::middleware(['auth', 'checkRole:BPP,Penata Dokumen Keuangan'])->prefix('honor')->name('honor.')->group(
    function () {
        Route::get('/', 'honorController@index')->name('index');
        Route::get('/create', 'honorController@create')->name('create');
        Route::post('/store', 'honorController@store')->name('store');
        Route::get('/{id}/edit', 'honorController@edit')->name('edit');
        Route::put('/{id}/update', 'honorController@update')->name('update');
    }
);

Route::middleware(['auth', 'checkRole:BPP'])->prefix('bpp')->name('bpp.')->group(
    function () {
        Route::get('/', 'bppController@dashboard')->name('dashboard');

        //Route Honor Sempro
        Route::get('/honor-sempro', 'honorSemproController@bpp_index')->name('honor-sempro.index');
        Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@bpp_show')->name('honor-sempro.show');
        // Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@bpp_verif')->name('honor-sempro.verif');

        //Route Honor Skripsi
        Route::get('/honor-skripsi', 'honorSkripsiController@bpp_index')->name('honor-skripsi.index');
        Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@bpp_show')->name('honor-skripsi.show');
        // Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@bpp_verif')->name('honor-skripsi.verif');

        //Kepegawaian & Keuangan
        Route::get('/surat_tugas', 'kepegawaianController@bpp_index')->name('surat.index');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@bpp_preview')->name('surat.preview');
        Route::get('/surat_tugas/{id}/approve', 'kepegawaianController@bpp_approve')->name('surat.approve');
        Route::get('/ganti_password', 'manageUserController@bpp_ganti_password')->name('ganti.password');
        Route::get('/spd', 'kepegawaianController@bpp_spd_index')->name('spd.index');
        Route::get('/spd/{id}/view', 'kepegawaianController@bpp_spd_preview')->name('spd.view');
        Route::get('/spd/{id}/download', 'kepegawaianController@download_bukti')->name('spd.download');
        Route::get('/spd/{id}/selesai', 'kepegawaianController@bpp_selesai')->name('spd.selesai');
    }
);

Route::middleware(['auth', 'checkRole:Wakil Dekan 2'])->prefix('wadek2')->name('wadek2.')->group(
    function () {
        Route::get('/', 'wadek2Controller@dashboard')->name('dashboard');

        //Route SK Sempro
        Route::get('/sk-sempro', 'SkSemproController@wadek2_index')->name('sk-sempro.index');
        Route::get('/sk-sempro/{id_sk_sempro}', 'SkSemproController@wadek2_show')->name('sk-sempro.show');

        //Route SK Skripsi
        Route::get('/sk-skripsi', 'SkSkripsiController@wadek2_index')->name('sk-skripsi.index');
        Route::get('/sk-skripsi/{id_sk_skripsi}', 'SkSkripsiController@wadek2_show')->name('sk-skripsi.show');

        //Route Honor Sempro
        Route::get('/honor-sempro', 'honorSemproController@wadek2_index')->name('honor-sempro.index');
        Route::get('/honor-sempro/{id_sk_honor}', 'honorSemproController@wadek2_show')->name('honor-sempro.show');
        Route::put('/honor-sempro/verif/{id_sk_honor}', 'honorSemproController@wadek2_verif')->name('honor-sempro.verif');

        //Route Honor Skripsi
        Route::get('/honor-skripsi', 'honorSkripsiController@wadek2_index')->name('honor-skripsi.index');
        Route::get('/honor-skripsi/{id_sk_honor}', 'honorSkripsiController@wadek2_show')->name('honor-skripsi.show');
        Route::put('/honor-skripsi/verif/{id_sk_honor}', 'honorSkripsiController@wadek2_verif')->name('honor-skripsi.verif');

        //Mahasiswa Bimbingan
        Route::get('/pembimbing-skripsi', 'dosenController@index_pembimbing')->name('pembimbing-skripsi');
        Route::get('/pembimbing-skripsi/{nim}', 'dosenController@show_pembimbing')->name('pembimbing-skripsi.show');

        //Mahasiswa Ujian Sempro
        Route::get('/pembahas-sempro', 'dosenController@index_pembahas')->name('pembahas-sempro');
        Route::get('/pembahas-sempro/{nim}', 'dosenController@show_pembahas')->name('pembahas-sempro.show');

        //Mahasiswa Ujian Skripsi
        Route::get('/penguji-skripsi', 'dosenController@index_penguji')->name('penguji-skripsi');
        Route::get('/penguji-skripsi/{nim}', 'dosenController@show_penguji')->name('penguji-skripsi.show');

        //Verif pengadaan
        Route::resource(
            'pengadaan', 'pengadaanController', [
            'only' => ['index', 'show', 'update']
            ]
        );

        //Kepegawaian
        Route::get('/memu', 'kepegawaianController@memu')->name('memu.index');
        Route::get('/memu/create', 'kepegawaianController@createMemu')->name('memu.create');
        Route::post('/memu/save', 'kepegawaianController@saveMemu')->name('memu.save');
        Route::delete('memu/{id}/delete', 'kepegawaianController@deleteMemu')->name('memu.delete');
        Route::get('/memu/{id}/edit', 'kepegawaianController@editMemu')->name('memu.edit');
        Route::put('/memu/{id}/update', 'kepegawaianController@updateMemu')->name('memu.update');
        Route::get('/surat_tugas', 'kepegawaianController@wadek2_surat_index')->name('surat.index');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@wadek2_preview')->name('surat.preview');
        Route::get('/surat_tugas/{id}/approve', 'kepegawaianController@wadek2_surat_approve')->name('surat.approve');
        Route::get('/ganti_password', 'manageUserController@wadek2_ganti_password')->name('ganti.password');
        Route::resource(
            'pengadaan', 'pengadaanController', [
            'only' => ['index', 'show', 'update']
            ]
        );
    }
);

Route::middleware(['auth', 'checkRole:Dosen'])->prefix('dosen')->name('dosen.')->group(
    function () {
        Route::get('/', 'dosenController@dashboard')->name('dashboard');

        //Mahasiswa Bimbingan
        Route::get('/pembimbing-skripsi', 'dosenController@index_pembimbing')->name('pembimbing-skripsi');
        Route::get('/pembimbing-skripsi/{nim}', 'dosenController@show_pembimbing')->name('pembimbing-skripsi.show');

        //Mahasiswa Ujian Sempro
        Route::get('/pembahas-sempro', 'dosenController@index_pembahas')->name('pembahas-sempro');
        Route::get('/pembahas-sempro/{nim}', 'dosenController@show_pembahas')->name('pembahas-sempro.show');

        //Mahasiswa Ujian Skripsi
        Route::get('/penguji-skripsi', 'dosenController@index_penguji')->name('penguji-skripsi');
        Route::get('/penguji-skripsi/{nim}', 'dosenController@show_penguji')->name('penguji-skripsi.show');

        //Kepegawaian
        // Route::get('/','kepegawaianController@dosen_index')->name('index');
        Route::get('/upload', 'kepegawaianController@dosen_index_upload')->name('dosen_upload_index');
        Route::get('/upload/{id}/preview', 'kepegawaianController@dosen_upload_preview')->name('dosen_upload_preview');
        Route::get('/surat_tugas', 'kepegawaianController@dosen_index')->name('surat.index');
        Route::get('/surat_tugas/read', 'kepegawaianController@read')->name('surat.read');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@dosen_preview')->name('surat.preview');
        Route::get('/surat_tugas/{id}/cetak1', 'kepegawaianController@dosen_cetak1')->name('surat.cetak1');
        Route::get('/surat_tugas/{id}/cetak2', 'kepegawaianController@dosen_cetak2')->name('surat.cetak2');
        Route::get('/surat_tugas/{id}/cetak_spd', 'kepegawaianController@dosen_cetak_spd')->name('surat.cetak_spd');
        Route::get('/ganti_password', 'manageUserController@dosen_ganti_password')->name('ganti.password');
        Route::post('/upload/{id}', 'kepegawaianController@dosen_store')->name('file.upload');
        Route::get('/upload/{id}/edit', 'kepegawaianController@dosen_edit_upload')->name('edit.upload');
        Route::get('/penguji-skripsi', 'dosenController@index_penguji')->name('penguji-skripsi');
        Route::get('/penguji-skripsi/{nim}', 'dosenController@show_penguji')->name('penguji-skripsi.show');
    }
);

Route::middleware(['auth', 'checkRole:Pengadministrasi BMN'])->prefix('perlengkapan')->name('perlengkapan.')->group(
    function () {
        Route::get('/', 'PerlengkapanController@dashboard')->name('dashboard');
        Route::resource('inventaris', 'inventarisController');
        Route::resource('pengadaan', 'pengadaanController');
        Route::resource('peminjaman_barang', 'peminjamanBarangController');
        Route::get('/peminjaman_barang/barang/{id}', array('as' => 'barang.ajax', 'uses' => 'peminjamanBarangController@barangAjax'));
        Route::resource('peminjaman_ruang', 'peminjamanRuangController');
        Route::get('/peminjaman_ruang/ruang/{jumlah}', array('as' => 'ruang.ajax', 'uses' => 'peminjamanRuangController@ruangAjax'));
        Route::put('/peminjaman_barang/verif/{verif_baper}', 'peminjamanBarangController@verif_baper')->name('peminjaman_barang.verif');
        Route::put('/peminjaman_ruang/verif/{verif_baper}', 'peminjamanRuangController@verif_baper')->name('peminjaman_ruang.verif');
        Route::get('/pengadaan/{id}/getForm', 'pengadaanController@getForm')->name('pengadaan.getForm');
        Route::post('/pengadaan/{id}/saveItem', 'pengadaanController@saveItem')->name('pengadaan.saveItem');
    }
);

Route::middleware(['auth', 'checkRole:Pengadministrasi Layanan Kegiatan Mahasiswa'])->prefix('ormawa')->name('ormawa.')->group(
    function () {
        Route::get('/', 'OrmawaController@dashboard')->name('dashboard');
        Route::resource('peminjaman_barang', 'peminjamanBarangController');
        Route::get('/peminjaman_barang/barang/{id}', array('as' => 'barang.ajax', 'uses' => 'peminjamanBarangController@barangAjax'));
        Route::resource('peminjaman_ruang', 'peminjamanRuangController');
    }
);

Route::middleware(['auth', 'checkRole:Pengadministrasi Kemahasiswaan & Alumni'])->prefix('kemahasiswaan')->name('kemahasiswaan.')->group(
    function () {
        Route::get(
            '/', function () {
                return view('kemahasiswaan.dashboard');
            }
        )->name('dashboard');

        //Data Mahasiswa
        Route::get('/mahasiswa', 'mahasiswaController@index')->name('mahasiswa.index');
        Route::get('/mahasiswa/create', 'mahasiswaController@create')->name('mahasiswa.create');
        Route::post('/mahasiswa/store', 'mahasiswaController@store')->name('mahasiswa.store');
        Route::get('/mahasiswa/{nim}', 'mahasiswaController@show')->name('mahasiswa.show');
        Route::get('/mahasiswa/{nim}/edit', 'mahasiswaController@edit')->name('mahasiswa.edit');
        Route::put('/mahasiswa/{nim}/update', 'mahasiswaController@update')->name('mahasiswa.update');
    }
);

Route::middleware(['auth', 'checkRole:Wakil Dekan 1'])->prefix('wadek1')->name('wadek1.')->group(
    function () {
        Route::get('/', 'wadek1Controller@dashboard')->name('dashboard');

        //Mahasiswa Bimbingan
        Route::get('/pembimbing-skripsi', 'dosenController@index_pembimbing')->name('pembimbing-skripsi');
        Route::get('/pembimbing-skripsi/{nim}', 'dosenController@show_pembimbing')->name('pembimbing-skripsi.show');

        //Mahasiswa Ujian Sempro
        Route::get('/pembahas-sempro', 'dosenController@index_pembahas')->name('pembahas-sempro');
        Route::get('/pembahas-sempro/{nim}', 'dosenController@show_pembahas')->name('pembahas-sempro.show');

        //Mahasiswa Ujian Skripsi
        Route::get('/penguji-skripsi', 'dosenController@index_penguji')->name('penguji-skripsi');
        Route::get('/penguji-skripsi/{nim}', 'dosenController@show_penguji')->name('penguji-skripsi.show');
    }
);

Route::prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/pegawai', 'manageUserController@index')->name('pegawai.index');
        Route::get('/pegawai/create', 'manageUserController@create')->name('pegawai.create');
        Route::post('/pegawai/store', 'manageUserController@store')->name('pegawai.store');
        Route::get('/pegawai/edit/{id}', 'manageUserController@edit')->name('pegawai.edit');
        Route::put('/pegawai/update/{username}', 'manageUserController@update')->name('pegawai.update');
        Route::delete('/pegawai/delete/{username?}', 'manageUserController@destroy')->name('pegawai.destroy');
    }
);

Route::middleware(['auth', 'checkRole:Sekretaris Pimpinan'])->prefix('staffpim')->name('staffpim.')->group(
    function () {
        Route::get('/', 'kepegawaianController@sp_index')->name('index');
        Route::get('/surat', 'kepegawaianController@sp_read')->name('sp.read');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@sp_preview')->name('sp.preview');
        Route::get('/surat_tugas/{id}/approve', 'kepegawaianController@sp_surat_approve')->name('surat.approve');
        Route::put('/surat_tugas/{id}/reject', 'kepegawaianController@sp_surat_reject')->name('surat.reject');
        Route::get('/surat_tugas/{id}/alasan', 'kepegawaianController@sp_reject_view')->name('surat.reject.view');
        Route::get('/ganti_password', 'manageUserController@staffpim_ganti_password')->name('ganti.password');
    }
);

Route::middleware(['auth', 'checkRole:Pemroses Mutasi Kepegawaian'])->prefix('kepegawaian')->name('kepegawaian.')->group(
    function () {
        Route::get('/', 'kepegawaianController@index')->name('kepegawaian.index');
        Route::get('/surat_tugas', 'kepegawaianController@surat_index')->name('surat.index');
        Route::get('/surat_tugas/read', 'kepegawaianController@read')->name('surat.read');
        Route::get('/surat_tugas/{id}/create', 'kepegawaianController@surat_create')->name('surat.create');
        Route::put('/surat_tugas/{id}/save', 'kepegawaianController@surat_save')->name('surat.save');
        Route::get('/surat_tugas/cetak', 'kepegawaianController@kepegawaian_cetak')->name('surat.cetak');
        Route::get('/surat_tugas/{id}/cetak_pdf1', 'kepegawaianController@cetak_pdf1')->name('surat.cetak1');
        Route::get('/surat_tugas/{id}/cetak_pdf2', 'kepegawaianController@cetak_pdf2')->name('surat.cetak2');
        Route::get('/surat_tugas/{id}/cetak_pdf3', 'kepegawaianController@cetak_pdf3')->name('surat.cetak3');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@kepegawaian_preview')->name('surat.preview');
        Route::get('/surat_tugas/revisi', 'kepegawaianController@revisi')->name('surat.revisi');
        Route::get('/surat_tugas/{id}/edit', 'kepegawaianController@edit_sk')->name('surat.edit');
        Route::put('/surat_tugas/{id}/revisian', 'kepegawaianController@surat_revisian')->name('surat.revisian');
        // Route::get('/surat_tugas/{id}/spd', 'kepegawaianController@spd_create')->name('spd.create');
        Route::post('/surat_tugas/{id}/spd_save', 'kepegawaianController@spd_save')->name('spd.save');
        // Route::get('/surat_tugas/{id}/revisi', 'kepegawaianController@revisi_sk')->name('surat.revisian');
        Route::get('/ganti_password', 'manageUserController@kepegawaian_ganti_password')->name('ganti.password');
    }
);

//Dekan & Dosen Route
Route::middleware(['auth', 'checkRole:Dosen,Dekan'])->prefix('dosen')->name('dosen.')->group(
    function () {
        Route::get('/upload', 'kepegawaianController@dosen_index_upload')->name('dosen_upload_index');
        Route::get('/upload/{id}/preview', 'kepegawaianController@dosen_upload_preview')->name('dosen_upload_preview');
        Route::get('/surat_tugas', 'kepegawaianController@dosen_index')->name('surat.index');
        Route::get('/surat_tugas/read', 'kepegawaianController@read')->name('surat.read');
        Route::get('/surat_tugas/{id}/preview', 'kepegawaianController@dosen_preview')->name('surat.preview');
        Route::get('/surat_tugas/{id}/cetak1', 'kepegawaianController@dosen_cetak1')->name('surat.cetak1');
        Route::get('/surat_tugas/{id}/cetak2', 'kepegawaianController@dosen_cetak2')->name('surat.cetak2');
        Route::get('/surat_tugas/{id}/cetak_spd', 'kepegawaianController@dosen_cetak_spd')->name('surat.cetak_spd');
        Route::get('/ganti_password', 'manageUserController@dosen_ganti_password')->name('ganti.password');
        Route::post('/upload/{id}', 'kepegawaianController@dosen_store')->name('file.upload');
        Route::get('/upload/{id}/edit', 'kepegawaianController@dosen_edit_upload')->name('edit.upload');
        Route::get('/penguji-skripsi', 'dosenController@index_penguji')->name('penguji-skripsi');
        Route::get('/penguji-skripsi/{nim}', 'dosenController@show_penguji')->name('penguji-skripsi.show');
    }
);

//Ubah Password
Route::put('/ganti_password/{id}', 'manageUserController@simpan_password')->name('simpan.password');
