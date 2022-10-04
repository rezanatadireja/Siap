<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SubBidangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisPengaduanController;
use App\Http\Controllers\BidangPengaduanController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\JenisSyaratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\GuestController;

Route::get('/', function (){
    return view('guest.index');
});
Auth::routes();

Route::get('regencies', [PendudukController::class, 'regencies']);
Route::get('districts', [PendudukController::class, 'districts']);
Route::get('village', [PendudukController::class, 'villages']);
Route::get('informasi', [GuestController::class, 'info'])->name('info');
Route::get('cekpengaduan', [GuestController::class, 'cekPengaduan']);
Route::post('cekpengaduan/status', [GuestController::class, 'cekPengaduanStatus'])->name('cekPengaduanStatus');
Route::get('guest/formulir', [FormulirController::class, 'formulirGuest'])->name('formulirGuest');



Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route User
    Route::resource('users', UserController::class);
    Route::post('user/assignroles', [UserController::class, 'assignRoles'])->name('assign.roles');
    Route::post('user/create', [UserController::class, 'roleCreate'])->name('user.create');
    Route::get('permissions/{role_id?}', [UserController::class, 'permissionList'])->name('permissions.list');
    Route::post('permissions/create', [UserController::class, 'createPermission'])->name('permissions.create');
    Route::post('permissionrole/create', [UserController::class, 'rolePermissionMapping'])->name('permissionrole.create');

    Route::resource('bidangpengaduan', BidangPengaduanController::class);
    Route::resource('subbidang', SubBidangController::class);

    //Jenis Pengaduan
    Route::get('jenis-pengaduan', [JenisPengaduanController::class, 'index'])->name('jenis-pengaduan.index');
    Route::post('jenis-pengaduan', [JenisPengaduanController::class, 'store'])->name('jenis-pengaduan.store');
    Route::get('jenis-pengaduan/{id}/edit', [JenisPengaduanController::class, 'edit'])->name('jenis-pengaduan.edit');
    Route::put('jenis-pengaduan/{id}/update', [JenisPengaduanController::class, 'update'])->name('jenis-pengaduan.update');
    Route::delete('jenis-pengaduan/{id}/delete', [JenisPengaduanController::class, 'destroy'])->name('jenis-pengaduan.destroy');
    
    Route::get('admin/jenis-syarat', [JenisSyaratController::class, 'index'])->name('jenis-syarat.index');
    Route::post('admin/jenis-syarat/store', [JenisSyaratController::class, 'store']);
    Route::post('admin/jenis-syarat', [JenisSyaratController::class, 'update'])->name('jenis-syarat.update');
    Route::get('admin/jenis-syarat/{id}/edit', [JenisSyaratController::class, 'edit'])->name('jenis-syarat.edit');
    Route::post('admin/jenis-syarat/{id}/delete', [JenisSyaratController::class, 'destroy'])->name('jenis-syarat.destroy');

    //Penduduk
    Route::get('admin/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    Route::get('list-penduduk', [PendudukController::class, 'dataTable '])->name('list.penduduk');
    Route::resource('admin/penduduk', PendudukController::class);
    Route::get('/penduduk/{id}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
    Route::put('/penduduk/{id}/update', [PendudukController::class, 'update'])->name('penduduk.update');
    Route::delete('/penduduk/{id}/delete', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

    Route::get('pengaduan', [PendudukController::class, 'pendudukPengaduan'])->name('penduduk.pengaduan');
    Route::post('pengaduan', [PendudukController::class, 'daftarPengaduan'])->name('pengaduan.store');

    Route::get('pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.syarat');
    Route::get('pengaduan/syarat/{id}', [PengaduanController::class, 'getSyarat']);
    Route::get('pengaduan/syarat/{id}/show', [PengaduanController::class, 'showSyarat']);
    Route::post('pengaduan/syarat/update', [PengaduanController::class, 'updateSyarat'])->name('update.syarat');
    Route::post('pengaduan/syarat/{id}/delete', [PengaduanController::class, 'deleteSyarat'])->name('delete.syarat');
    Route::post('pengaduan/syarat', [PengaduanController::class, 'simpanSyarat'])->name('pengaduan.simpan');

    // Route::get('dashboard/mYpengaduan/{id}/showSyarat', [PengaduanController::class, 'showSyaratMy']);
    Route::get('dashboard/mYpengaduan', [PengaduanController::class, 'mYpengaduan']);
    Route::get('dashboard/mYpengaduan/{id}', [PengaduanController::class, 'getPengaduan']);
    Route::get('dashboard/pengaduan/{id}', [PengaduanController::class, 'lihatPengaduan']);
    Route::get('dashboard/pengaduan/show/{id}', [PengaduanController::class, 'showPengaduan']);
    Route::get('dashboard/pengaduan/show/syarat/{id}', [PengaduanController::class, 'showSyaratMy']);

    Route::get('list-pengaduan', [PendudukController::class, 'getJenisPelayanan']);
    Route::get('jenis-syarat', [PendudukController::class, 'getSyaratJenis']);
    // Route::get('admin/jenis-syarat', [JenisSyaratController::class, 'daftarJenisSyarat'])->name('list.syarat');


    Route::get('admin/pengaduan', [PengaduanController::class, 'adminIndex'])->name('admin.index');
    Route::get('pengaduan/semua', [PengaduanController::class, 'allPengaduan'])->name('allPengaduan');
    Route::get('admin/pengaduan/{id}', [PengaduanController::class, 'detailSyarat'])->name('show.pengaduan');
    Route::get('admin/pengaduan/syarat/{id}', [PengaduanController::class, 'lihatSyarat']);
    Route::post('admin/pengaduan/syarat/konfirmasi', [PengaduanController::class, 'konfirmasitSyarat'])->name('konfirmasi.syarat');
    Route::get('admin/pengaduan/update-pengaduan/{id}', [PengaduanController::class, 'updateStatusPengaduan'])->name('update.status');
    Route::get('admin/pengaduan/konfirmasi-pengaduan/{id}', [PengaduanController::class, 'lihatPesan' ]);
    Route::get('admin/pengaduan/kirim-pesan', [PengaduanController::class, 'kirimPesan'])->name('send.message');
    Route::post('admin/pengaduan/kirim-sms', PengaduanController::class)->name('kirimSMS');
    Route::post('admin/pengaduan/kirim-wa', [PengaduanController::class, 'notifyWhatsApp'])->name('kirimWA');

    Route::get('markAsRead', [PengaduanController::class, 'markAsRead'])->name('markAsRead');
    Route::get('notif/read/{id}', [PengaduanController::class, 'read'])->name('read');

    //BerkasFormulir
    Route::get('/formulir', [FormulirController::class, 'index'])->name('formulir');
    Route::post('/formulir/upload', [FormulirController::class, 'uploadBerkas'])->name('upload');
    Route::get('/files/formulir/{file}', [FormulirController::class, 'download'])->name('download');
    Route::post('/formulir/{id}/delete', [FormulirController::class, 'deleteFormulir'])->name('delete.formulir');
    Route::get('/formulir/{id}/edit', [FormulirController::class, 'deleteFormulir'])->name('delete.formulir');

    //Laporan Pengaduan
    Route::get('/laporan-pengaduan', [LaporanController::class, 'index'])->name('laporan-pengaduan');
    Route::get('/laporan-pengaduan/export-pengaduan', [LaporanController::class, 'export'])->name('export.excel');
    Route::get('/laporan-pengaduan/export-pdf', [LaporanController::class, 'exportPdf'])->name('exportPdf');

    //Penduduk
    Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.create');
    // Route::get('/penduduk/{id}/edit', [PendudukController::class, 'edit'])->name('edit.penduduk');
});

