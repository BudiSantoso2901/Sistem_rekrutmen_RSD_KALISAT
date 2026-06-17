<?php

use App\Http\Controllers\ScanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\HasilKuisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('coming');
});

// Route::get('/', [PelamarController::class, 'tampil_halaman_pelamar'])->name('pelamar.form');
// Route::post('/pelamar/store', [PelamarController::class, 'store'])->name('pelamar.store');
Route::get('/pelamar/hasil/{token}', [PelamarController::class, 'hasil'])
    ->name('Pelamar.hasil');

Route::get('/login-rs/halamanLogin', [AuthController::class, 'tampil_login'])->name('login');
Route::post('/login-prosess', [AuthController::class, 'proses_login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/file/view/{id}', [PelamarController::class, 'viewFile'])
    ->name('file.view');

Route::get('/faq-preview', function () {

    $path = public_path(
        'file_template/faq.pdf'
    );

    return Response::file($path);
});
// Route::prefix('admin/scan')->name('admin.scan.')->group(function () {
//     Route::get('/',             [ScanController::class, 'index'])->name('index');
//     Route::get('/cari',         [ScanController::class, 'cari'])->name('cari');
//     Route::post('/cari',        [ScanController::class, 'cari'])->name('cari.post');  // fallback form POST
//     Route::get('/hasil/{token}', [ScanController::class, 'hasil'])->name('hasil');
// });

Route::middleware(['auth'])->group(function () {
    // IT
    Route::middleware('role:IT')->group(function () {
        Route::get('/export/data-pelamar', [PelamarController::class, 'exportExcel'])->name('pelamar.export');
        Route::get('/dashboard/IT', [PelamarController::class, 'dash_it'])->name('dashboard');
        Route::get('/list/pelamar', [PelamarController::class, 'tampil_halaman_validasi'])
            ->name('sdm.pelamar');
        Route::get('/pelamar/detail/{token}', [PelamarController::class, 'detail_pelamar'])
            ->name('pelamar.detail');
        Route::post('/pelamar/validasi/{token}', [PelamarController::class, 'validasi'])
            ->name('pelamar.validasi');
        Route::post('/pelamar/reset-password/{token}', [PelamarController::class, 'resetPassword'])
            ->name('pelamar.reset-password');

        //Hasil Kuis
        Route::get('hasil-kuis', [HasilKuisController::class, 'index'])
            ->name('hasil-kuis.index');
        Route::get('hasil-kuis/{pengerjaanPelamar}', [HasilKuisController::class, 'show'])
            ->name('hasil-kuis.show');
        Route::patch('hasil-kuis/{pengerjaanPelamar}/status', [HasilKuisController::class, 'updateStatus'])
            ->name('hasil-kuis.update-status');
        Route::delete('hasil-kuis/{pengerjaanPelamar}', [HasilKuisController::class, 'destroy'])
            ->name('hasil-kuis.destroy');

        Route::prefix('posisi')->group(function () {
            Route::get('/', [PosisiController::class, 'index'])->name('sdm.posisi.index');
            Route::post('/store', [PosisiController::class, 'store'])->name('sdm.posisi.store');
            Route::delete('/delete/{id}', [PosisiController::class, 'destroy'])->name('sdm.posisi.delete');
        });
        Route::prefix('/kuis')->group(function () {
            Route::get('/', [KuisController::class, 'index'])->name('sdm.kuis.index');
            Route::post('/store', [KuisController::class, 'store'])->name('sdm.kuis.store');
            Route::get('/{id}',      [KuisController::class, 'show'])->name('show');
            Route::delete('/delete/{id}', [KuisController::class, 'destroy'])->name('sdm.kuis.delete');
            Route::post('/{id}/duplicate', [KuisController::class, 'duplicate'])->name('sdm.kuis.duplicate');
        });
        Route::prefix('sdm/kuis/{kuisId}/soal')->name('soal.')->group(function () {
            Route::get('/page',      [KuisController::class, 'soalPage'])->name('page');
            Route::get('/',          [KuisController::class, 'soalIndex'])->name('index');
            Route::post('/store',    [KuisController::class, 'soalStore'])->name('store');
            Route::delete('/{soalId}', [KuisController::class, 'soalDestroy'])->name('destroy');
        });

        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AuthController::class, 'updatePassword'])->name('profile.update');
    });

    // SDM
    Route::middleware('role:SDM')->group(function () {
        Route::get('/sdm/dashboard', function () {
            return view('dashboard.sdm');
        })->name('sdm.dashboard');
    });
});

Route::middleware(['auth:pelamar'])->group(function () {
    Route::get('/pelamar/dashboard',      [PelamarController::class, 'dashboard_pelamar'])->name('pelamar.dashboard');
    Route::post('/file/upload', [PelamarController::class, 'upload'])
        ->name('file.upload');

    // Hapus file berdasarkan jenis
    Route::delete('pelamar/file/{jenis}', [PelamarController::class, 'deleteFile'])
        ->name('file.delete');
});
