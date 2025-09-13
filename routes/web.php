<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return redirect()->route('arsip.index');
});

Route::get('/arsip', [ArsipSuratController::class, 'index'])->name('arsip.index');
Route::get('/arsip/create', [ArsipSuratController::class, 'create'])->name('arsip.create');
Route::post('/arsip', [ArsipSuratController::class, 'store'])->name('arsip.store');
Route::get('/arsip/{id}/view', [ArsipSuratController::class, 'view'])->name('arsip.view');
Route::get('/arsip/{id}/download', [ArsipSuratController::class, 'download'])->name('arsip.download');
Route::delete('/arsip/{id}', [ArsipSuratController::class, 'destroy'])->name('arsip.destroy');
Route::get('/about', [ArsipSuratController::class, 'about'])->name('about');

Route::resource('kategori', KategoriController::class);
