<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// SEMUA RUTE DI BAWAH INI WAJIB LOGIN (AUTH)
Route::middleware('auth')->group(function () {

    // --- FITUR PROFILE Bawaan Laravel ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- FITUR MASTER BARANG ---
    Route::get('/master-barang/export/excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
    Route::get('/master-barang/export-pdf', [ProductController::class, 'exportPdf'])->name('products.export_pdf');
    Route::get('/master-barang', [ProductController::class, 'index'])->name('products.index');
    Route::get('/master-barang/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/master-barang', [ProductController::class, 'store'])->name('products.store');
    Route::get('/master-barang/{id}/detail', [ProductController::class, 'show'])->name('products.show');
    Route::get('/master-barang/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/master-barang/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/master-barang/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // --- FITUR PEMINJAMAN ---
    Route::get('/peminjaman/export-pdf', [BorrowingController::class, 'exportPdf'])->name('borrowings.export_pdf');
    Route::get('/peminjaman', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/peminjaman/create', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/peminjaman', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::put('/peminjaman/{borrowing}/return', [BorrowingController::class, 'returnProduct'])->name('borrowings.return');

    // --- FITUR LAPORAN (Hanya Super Admin & Manager) ---
    Route::get('/laporan', function () {
        if (in_array(auth()->user()->role_id, [1, 2])) {
            return view('laporan.index');
        }
        abort(403, 'AKSES DITOLAK: Halaman ini khusus untuk Manajemen dan Auditor.');
    })->name('laporan.index');

    // --- FITUR KELOLA PENGGUNA ---
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';
