<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\Writer\WriterController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::resource('/buku', BukuController::class);
Route::get('/dataTable-buku', [BukuController::class, 'dataTable'])->name('data-table-buku');
Route::resource('/category', CategoryController::class);
Route::get('/dataTable-category', [CategoryController::class, 'dataTable'])->name('data-table-category');
Route::resource('/penerbit', PenerbitController::class);
Route::get('/dataTable-penerbit', [PenerbitController::class, 'dataTable'])->name('data-table-penerbit');
Route::resource('/penulis', PenulisController::class);
Route::get('/dataTable-penulis', [PenulisController::class, 'dataTable'])->name('data-table-penulis');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::get('/laporan-export', [LaporanController::class, 'export'])->name('laporan.export');
Route::get('/writer-buku', [WriterController::class, 'index'])->name('writer-buku.index');
Route::get('/writer-buku/{uuid}', [WriterController::class, 'show'])->name('writer-buku.detail');

Route::get('/dataTable-writer', [WriterController::class, 'dataTable'])->name('data-table-writer');
