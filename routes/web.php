<?php

use App\Http\Controllers\JampelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
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
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // jadwal
    Route::get('/admin/jadwal', [AdminController::class, 'AdminJadwal'])->name('admin.jadwal');
    
    // jurnal
    Route::get('/admin/jurnal', [AdminController::class, 'AdminJurnal'])->name('admin.jurnal');

    // master periode
    Route::get('/admin/master-periode', [PeriodeController::class, 'index'])->name('admin.masterdata.periode');
    
    // master mapel
    Route::get('/admin/master-mapel', [MapelController::class, 'index'])->name('admin.masterdata.mapel');
    
    // master jampel
    Route::get('/admin/master-jampel', [JampelController::class, 'index'])->name('admin.masterdata.jampel');
    
    // master kelas
    Route::get('/admin/master-kelas', [KelasController::class, 'index'])->name('admin.masterdata.kelas');

});
// End Group Admin Middleware

Route::middleware(['auth','role:guru'])->group(function(){
    Route::get('/guru/dashboard', [GuruController::class, 'GuruDashboard'])->name('guru.dashboard');
    
});
// End Group Guru Middleware