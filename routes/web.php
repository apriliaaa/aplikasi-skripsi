<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\ProgramStudiController;
use Illuminate\Support\Facades\Artisan;
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
    return view('auth.login');
});

Route::get('/storage', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});

Route::get('/dashboard-chart', [DashboardController::class, "getDataChart"])->name('dashboard.chart');
Route::get('/dashboard-chart/{prodi}', [DashboardController::class, "getDataByProdiChart"])->name('dashboard.chart.prodi');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
});

Route::prefix('admin')->middleware(['superAdmin', 'auth:sanctum'])->group(function () {
    Route::get('/create-admin', [AdminController::class, "create"])->name("admin.create");
    Route::post('/create-admin', [AdminController::class, "store"])->name("admin.save");
    Route::get('/data-admin', [AdminController::class, "index"])->name('admin.data');
    Route::delete('/data-admin/{id}', [AdminController::class, "destroy"])->name('admin.delete');
    Route::get('/edit-admin/{id}', [AdminController::class, "edit"])->name('admin.edit');
    Route::post('/edit-admin/{id}', [AdminController::class, "update"])->name('admin.update');
});


Route::prefix('dosen')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/create-dosen', [DosenController::class, "create"])->name('dosen.create');
    Route::post('/create-dosen', [DosenController::class, "store"])->name('dosen.save');
    Route::get('/data-dosen', [DosenController::class, "index"])->name('dosen.data');
    Route::delete('/data-dosen/{id}', [DosenController::class, "destroy"])->name('dosen.delete');
    Route::get('/edit-dosen/{id}', [DosenController::class, "edit"])->name('dosen.edit');
    Route::post('/edit-dosen/{id}', [DosenController::class, "update"])->name('dosen.update');
});

Route::middleware('auth:sanctum')->get('/prodi', [ProgramStudiController::class, "index"])->name('prodi');
Route::middleware('auth:sanctum')->post('/create-prodi', [ProgramStudiController::class, "store"])->name('prodi.create');
Route::middleware('auth:sanctum')->delete('/prodi/{id}', [ProgramStudiController::class, "destroy"])->name("prodi.delete");

Route::middleware('auth:sanctum')->get('/pelanggaran', [PelanggaranController::class, "index"])->name('pelanggaran');
Route::middleware('auth:sanctum')->post('/create-pelanggaran', [PelanggaranController::class, "store"])->name('pelanggaran.create');
Route::middleware('auth:sanctum')->delete('/pelanggaran/{id}', [PelanggaranController::class, "destroy"])->name("pelanggaran.delete");

Route::middleware('auth:sanctum')->get('/dokumen', [ItemController::class, "index"])->name('dokumen');
Route::middleware('auth:sanctum')->post('/create-dokumen', [ItemController::class, "store"])->name('dokumen.create');
Route::middleware('auth:sanctum')->delete('/dokumen/{id}', [ItemController::class, "destroy"])->name("dokumen.delete");


Route::middleware('auth:sanctum')->get('/mahasiswa/create-dataMahasiswa', [MahasiswaController::class, "create"])->name("mahasiswa.create");
Route::middleware('auth:sanctum')->post('/mahasiswa/create-mahasiswa', [MahasiswaController::class, "store"])->name("mahasiswa.save");
Route::middleware('auth:sanctum')->get('/mahasiswa/exist', [MahasiswaController::class, "getByName"])->name("mahasiswa.exist");
Route::middleware('auth:sanctum')->get('/mahasiswa/data-mahasiswa', [MahasiswaController::class, "index"])->name('mahasiswa.data');
Route::middleware('auth:sanctum')->delete('/mahasiswa/data-mahasiswa/{id}', [MahasiswaController::class, "destroyPelanggaran"])->name('mahasiswa.dataDelete');

Route::middleware('auth:sanctum')->get('/laporan/detail-prodi', [MahasiswaController::class, "detailReport"])->name("laporan.detail");
Route::middleware(['superAdmin', 'auth:sanctum'])->get('/laporan/prodi', [MahasiswaController::class, "prodiReport"])->name("laporan.prodi");
Route::middleware('auth:sanctum')->get('/laporan/mahasiswa', [MahasiswaController::class, "mahasiswaReport"])->name("laporan.mahasiswa");

// Cetak laporan
Route::middleware('auth:sanctum')->get('/cetak-laporan/mahasiswa/{nama_prodi}', [MahasiswaController::class, "mahasiswaReportExport"])->name('cetak.mahasiswa');
Route::middleware('auth:sanctum')->get('/cetak-laporan/detail-prodi/', [MahasiswaController::class, "detailReportExport"])->name('cetak.detail.prodi');
Route::middleware('auth:sanctum')->post('/cetak-laporan/mahasiswa/', [MahasiswaController::class, "mahasiswaPerProdiReportExport"])->name('cetak.mahasiswa.prodi');
Route::middleware(['auth:sanctum', 'superAdmin'])->get('/cetak-laporan/prodi/', [MahasiswaController::class, "prodiReportExport"])->name('cetak.prodi');

Route::middleware('auth:sanctum')->put('/user/profile/info', [AdminController::class, "updateUserInfo"])->name('update.user.info');
Route::middleware('auth:sanctum')->put('/user/profile/auth', [AdminController::class, "updateUserAuth"])->name('update.user.auth');


Route::get('reset', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});
