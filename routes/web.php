<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('login');
});

Route::get('/login',[AuthController::class,'ShowLoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'ShowRegister'])->name('register');
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/surat',[AdminController::class,'showAduan'])->name('admin.surat');
    Route::get('/admin/data_laporan',[AdminController::class,'data_laporan'])->name('admin.data_laporan');
    Route::get('/admin/backup',[AdminController::class,'backup'])->name('admin.backup');
    Route::get('/admin/add_laporan',[AdminController::class,'view_add_laporan'])->name('admin.add_laporan');
    Route::post('/admin/add_laporan/store',[AdminController::class,'fadd_laporan'])->name('admin.fadd_laporan');
    Route::get('/admin/exportLaporan_pdf', [AdminController::class, 'exportLaporan_pdf'])->name('admin.exportLaporan_pdf');
    Route::get('/admin/exportSTPA_pdf', [AdminController::class, 'exportSurat_pdf'])->name('admin.exportSTPA_pdf');
    Route::delete('/admin/delete_laporan/{id}',[AdminController::class,'delete_laporan'])->name('admin.delete_laporan');
    Route::get('/admin/update_laporan/{id}',[AdminController::class,'showUpdate_laporan'])->name('admin.update_laporan');
    Route::put('/admin/fupdate_laporan/{id}',[AdminController::class,'fupdate_laporan'])->name('admin.fupdate_laporan');
    Route::get('/admin/detail_laporan/{id}',[AdminController::class,'detail_laporan'])->name('admin.detail_laporan');
    Route::get('/admin/add_surat', [AdminController::class,'add_surat'])->name('admin.add_surat');
    Route::post('/admin/add_surat/store',[AdminController::class,'fadd_surat'])->name('admin.fadd_surat');
    Route::get('/admin/surat/{aduan}/download',[AdminController::class,'downloadPdf'])->name('admin.download');
    Route::get('/admin/detail_surat/{id}',[AdminController::class,'detail_surat'])->name('admin.detail_surat');
    Route::delete('/admin/delete_surat/{id}',[AdminController::class,'delete_surat'])->name('admin.delete_surat');
    Route::get('/admin/update_surat/{id}',[AdminController::class,'update_surat'])->name('admin.update_surat');
    Route::put('/admin/fupdate_surat/{id}',[AdminController::class,'fupdate_surat'])->name('admin.fupdate_surat');
    Route::get('/admin/pengaturan',[AdminController::class,'pengaturan'])->name('admin.pengaturan');
    Route::put('/admin/update_profil',[AdminController::class,'updateProfile'])->name('admin.updateProfile');
    Route::put('/admin/update_password',[AdminController::class,'updatePassword'])->name('admin.updatePassword');
    Route::get('/admin/kelola_user',[AdminController::class,'kelola_user'])->name('admin.kelola_user');
    Route::get('/admin/add_user',[AdminController::class,'add_user'])->name('admin.add_user');
    Route::post('/admin/fadd_user',[AdminController::class,'fadd_user'])->name('admin.fadd_user');
    Route::get('/admin/update_user/{id}',[AdminController::class,'update_user'])->name('admin.update_user');
    Route::put('/admin/fupdate_user/{id}',[AdminController::class,'fupdate_user'])->name('admin.fupdate_user');
    Route::delete('/admin/delete_user/{id}',[AdminController::class,'delete_user'])->name('admin.delete_user');
    Route::get('/admin/data_laporan/{laporan}/preview',[AdminController::class, 'previewPdf'])->name('admin.preview');
});
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/user/dashboard',[UserController::class,'dashboard'])->name('user.dashboard');
    Route::post('/user/dashboard/store',[UserController::class,'store'])->name('user.store');
    Route::post('/user/dashboard/add_surat',[UserController::class,'add_surat'])->name('user.add_surat');
    Route::get('/user/show/{laporan}',[UserController::class,'show'])->name('user.show');
    Route::get('/user/show/edit/{laporan}',[UserController::class,'edit'])->name('user.edit');
    Route::put('/user/show/{laporan}',[UserController::class,'update'])->name('user.update');
    Route::get('/user/show/{laporan}/preview',[UserController::class,'previewPdf'])->name('user.preview');
    Route::get('/user/show/{laporan}/download',[UserController::class,'downloadPdf'])->name('user.download');
});