<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingController;

Route::get('/', [InvitationController::class, 'index'])->name('undangan.index');
Route::post('/rsvp', [InvitationController::class, 'rsvp'])->name('undangan.rsvp');

Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AdminController::class, 'processLogin'])->name('admin.login.process');

Route::middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    Route::get('/dashboard/guests/export', [GuestController::class, 'exportCsv'])->name('guests.export');
    Route::get('/dashboard/guests/export-pdf', [GuestController::class, 'exportPdf'])->name('guests.export_pdf');
    Route::resource('dashboard/guests', GuestController::class)->except(['create', 'show', 'edit']);
    Route::resource('dashboard/galleries', GalleryController::class)->except(['create', 'show', 'edit']);
    
    Route::get('/dashboard/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/dashboard/settings', [SettingController::class, 'store'])->name('settings.store');
});
