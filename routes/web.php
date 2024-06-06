<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JampelController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MasterGuruController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;


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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    
    // profile
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    // Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // jadwal
    Route::get('/admin/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');
    
    // jurnal
    Route::get('/admin/jurnal', [JurnalController::class, 'index'])->name('admin.jurnal');

    // master guru
    Route::get('admin/master-guru', [MasterGuruController::class, 'index'])->name('admin.masterdata.guru');

    // master periode
    Route::get('/admin/master-periode', [PeriodeController::class, 'index'])->name('admin.masterdata.periode');
    Route::post('/admin/master-periode/add', [PeriodeController::class, 'store'])->name('admin.masterdata.periode.add');
    Route::post('/admin/master-periode/edit', [PeriodeController::class, 'update'])->name('admin.masterdata.periode.edit');
    Route::delete('/admin/master-periode/{periode}', [PeriodeController::class, 'destroy'])->name('admin.masterdata.periode.delete');
    
    // master mapel
    Route::get('/admin/master-mapel', [MapelController::class, 'index'])->name('admin.masterdata.mapel');
    Route::post('/admin/master-mapel/add', [MapelController::class, 'store'])->name('admin.masterdata.mapel.add');
    Route::post('/admin/master-mapel/edit', [MapelController::class, 'update'])->name('admin.masterdata.mapel.edit');
    Route::delete('/admin/master-mapel/{mapel}', [MapelController::class, 'destroy'])->name('admin.masterdata.mapel.delete');

    
    // master jampel
    Route::get('/admin/master-jampel', [JampelController::class, 'index'])->name('admin.masterdata.jampel');
    Route::post('/admin/master-jampel/add', [JampelController::class, 'store'])->name('admin.masterdata.jampel.add');
    Route::post('/admin/master-jampel/edit', [JampelController::class, 'update'])->name('admin.masterdata.jampel.edit');
    Route::delete('/admin/master-jampel/{jampel}', [JampelController::class, 'destroy'])->name('admin.masterdata.jampel.delete');

    
    // master kelas
    Route::get('/admin/master-kelas', [KelasController::class, 'index'])->name('admin.masterdata.kelas');
    Route::post('/admin/master-kelas/add', [KelasController::class, 'store'])->name('admin.masterdata.kelas.add');
    Route::post('/admin/master-kelas/edit', [KelasController::class, 'update'])->name('admin.masterdata.kelas.edit');
    Route::delete('/admin/master-kelas/{kelas}', [KelasController::class, 'destroy'])->name('admin.masterdata.kelas.delete');


});
// End Group Admin Middleware

Route::middleware(['auth','role:guru'])->group(function(){
    Route::get('/guru/dashboard', [GuruController::class, 'GuruDashboard'])->name('guru.dashboard');
    
});
// End Group Guru Middleware