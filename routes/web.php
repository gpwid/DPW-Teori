<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AdminController;

Route::get('/', [InvitationController::class, 'index'])->name('undangan.index');

Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AdminController::class, 'processLogin'])->name('admin.login.process');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/dashboard/konten', [AdminController::class, 'konten'])->name('admin.konten');
Route::post('/dashboard/konten', [AdminController::class, 'updateKonten'])->name('admin.konten.update');
Route::get('/dashboard/tamu', [AdminController::class, 'tamu'])->name('admin.tamu');
Route::get('/dashboard/galeri', [AdminController::class, 'galeri'])->name('admin.galeri');
Route::post('/dashboard/galeri/upload', [AdminController::class, 'uploadGaleri'])->name('admin.galeri.upload');
Route::post('/dashboard/galeri/update/{id}', [AdminController::class, 'updateGaleri'])->name('admin.galeri.update');
Route::post('/dashboard/galeri/delete/{id}', [AdminController::class, 'deleteGaleri'])->name('admin.galeri.delete');
Route::post('/dashboard', [AdminController::class, 'dashboardAction'])->name('admin.dashboard.action');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
