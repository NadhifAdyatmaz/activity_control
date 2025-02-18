<?php

use App\Http\Controllers\GuruJadwalController;
use App\Http\Controllers\GuruJurnalController;
use App\Http\Controllers\GuruprofileController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JampelController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MasterGuruController;
use App\Http\Controllers\PDFController;
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

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified', 'role:kepsek'])->group(function () {
  Route::get('/kepsek/dashboard', [KepsekController::class, 'kepsekDashboard'])->name('kepsek.dashboard');

  Route::get('/kepsek/profile', [KepsekController::class, 'kepsekProfile'])->name('kepsek.profile');
  Route::patch('/kepsek/profile', [KepsekController::class, 'updateProfile'])->name('kepsek.profile.update');

  Route::get('/kepsek/jadwal', [KepsekController::class, 'jadwal'])->name('kepsek.jadwal');

  Route::get('/kepsek/jurnal', [KepsekController::class, 'jurnal'])->name('kepsek.jurnal');

  Route::get('/kepsek/jadwal/viewpdf', [PDFController::class, 'viewJadwaladm'])->name('kepsek.jadwal.viewpdf');
  Route::get('/kepsek/jurnal/viewpdf', [PDFController::class, 'viewPdfadm'])->name('kepsek.jurnal.viewpdf');

});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

  // profile
  Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
  // Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/admin/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // jadwal
  Route::get('/admin/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');
  Route::post('/admin/jadwal/add', [JadwalController::class, 'store'])->name('admin.jadwal.add');
  Route::post('/admin/jadwal/insert', [JadwalController::class, 'insert'])->name('admin.jadwal.insert');
  Route::post('/admin/jadwal/edit', [JadwalController::class, 'update'])->name('admin.jadwal.update');
  Route::delete('/admin/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('admin.jadwal.delete');

  // jurnal
  Route::get('/admin/jurnal', [JurnalController::class, 'index'])->name('admin.jurnal');
  Route::post('/admin/jurnal/{approve}', [JurnalController::class, 'approve'])->name('admin.jurnal.approve');

  // Info
  Route::get('/admin/info', [InformationController::class, 'index'])->name('admin.info');
  Route::post('/admin/info/add', [InformationController::class, 'store'])->name('admin.info.add');
  Route::post('/admin/info/update', [InformationController::class, 'update'])->name('admin.info.update');
  Route::post('/admin/info/edit/{info}', [InformationController::class, 'edit'])->name('admin.info.edit');

  // master guru
  Route::get('admin/master-guru', [MasterGuruController::class, 'index'])->name('admin.masterdata.guru');
  Route::post('admin/master-guru/add', [MasterGuruController::class, 'store'])->name('admin.masterdata.guru.add');
  Route::post('admin/master-guru/import', [MasterGuruController::class, 'import'])->name('admin.masterdata.guru.import');
  Route::delete('admin/master-guru/{guru}', [MasterGuruController::class, 'destroy'])->name('admin.masterdata.guru.delete');

  // master periode
  Route::get('/admin/master-periode', [PeriodeController::class, 'index'])->name('admin.masterdata.periode');
  // Route::get('/admin/master-periode', [PeriodeController::class, 'search'])->name('admin.masterdata.search');
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

  Route::get('/admin/jadwal/viewpdf', [PDFController::class, 'viewJadwaladm'])->name('admin.jadwal.viewpdf');
  
  Route::get('/admin/jurnal/viewpdf', [PDFController::class, 'viewPdfadm'])->name('admin.jurnal.viewpdf');
  Route::get('/admin/jurnal/exportpdf', [PDFController::class, 'exportPdfadm'])->name('admin.jurnal.exportpdf');

});
// End Group Admin Middleware

Route::middleware(['auth', 'verified', 'role:guru'])->group(function () {
  Route::get('/guru/dashboard', [GuruController::class, 'GuruDashboard'])->name('guru.dashboard');

  Route::get('/guru/profile', [GuruprofileController::class, 'GuruProfil'])->name('guru.profile');
  // Rute untuk memperbarui profil pengguna yang sedang login
  Route::patch('/guru/profile', [GuruprofileController::class, 'update'])->name('guru.profile.update');
  // Rute untuk menampilkan form edit profil
  //Route::get('/guru/profile/edit', [GuruController::class, 'edit'])->name('guru.profile.edit');

  Route::get('/guru/jadwal', [GuruJadwalController::class, 'GuruJadwal'])->name('guru.jadwal');
  Route::post('/guru/jadwal/add', [GuruJadwalController::class, 'store'])->name('guru.jadwal.add');
  Route::post('/guru/jadwal/insert', [GuruJadwalController::class, 'insert'])->name('guru.jadwal.insert');

  Route::get('/guru/jadwal/viewpdf', [PDFController::class, 'viewJadwalguru'])->name('guru.jadwal.viewpdf');
  Route::get('/guru/jadwal/exportpdf', [PDFController::class, 'exporJadwalguru'])->name('guru.jadwal.exportpdf');

  Route::get('/guru/jurnal', [GuruJurnalController::class, 'Gurujurnal'])->name('guru.jurnal');
  // Route::post('/guru/jurnal', [GuruJurnalController::class, 'update'])->name('guru.jurnal.edit');
  // Route::post('/guru/jurnal/insert', [GuruJurnalController::class, 'insert'])->name('guru.jurnal.insert');
  Route::post('/guru/jurnal/update', [GuruJurnalController::class, 'update'])->name('guru.jurnal.update');
  Route::post('/guru/jurnal/{jurnal}', [GuruJurnalController::class, 'edit'])->name('guru.jurnal.edit');
  // Route::post('guru/jurnal/{ttd}', [GuruJurnalController::class, 'sendTtd'])->name('guru.jurnal.ttd');
  Route::post('/guru/jurnal/{id}/ttd', [GuruJurnalController::class, 'sendTtd'])->name('guru.jurnal.ttd');
  Route::delete('/guru/jurnal/{jurnal}', [GuruJurnalController::class, 'destroy'])->name('guru.jurnal.delete');

  Route::get('/guru/jurnal/viewpdf', [PDFController::class, 'viewPdfguru'])->name('guru.jurnal.viewpdf');
  Route::get('/guru/jurnal/exportpdf', [PDFController::class, 'exportPdfguru'])->name('guru.jurnal.exportpdf');
});
// End Group Guru Middleware