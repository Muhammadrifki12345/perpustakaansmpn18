<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ActivityActionController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard & Profil (Semua User)
    Route::get('/dasbor', [DashboardController::class, 'index'])->name('dasbor');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profil.destroy');

    // --- AKSES KATALOG (HANYA SISWA & PENGURUS - Super Admin DILARANG) ---
    Route::middleware(['can:access-catalog'])->group(function () {
        Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
        Route::get('/buku/{book}', [BookController::class, 'show'])->name('buku.show');
        
        // Akses Khusus Siswa di dalam Katalog
        // Akses Peminjaman (Shared between Siswa & Admin)
        Route::get('/peminjaman', [LoanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/{loan}', [LoanController::class, 'show'])->name('peminjaman.show');
        Route::get('/peminjaman/{loan}/invoice', [LoanController::class, 'invoice'])->name('peminjaman.invoice');

        // Akses Khusus Siswa
        Route::middleware(['role:siswa'])->group(function () {
            Route::get('/buku/{book}/baca', [BookController::class, 'read'])->name('buku.read');
            Route::post('/buku/{book}/rate', [BookController::class, 'storeRating'])->name('buku.rate');
            Route::post('/buku/{book}/favorit', [FavoriteController::class, 'toggle'])->name('buku.favorite');
            Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit.index');
            Route::post('/peminjaman', [LoanController::class, 'store'])->name('peminjaman.store');
        });
    });

    // --- AKSES PENGURUS (OPERASIONAL SAJA) ---
    Route::middleware(['can:admin-access'])->group(function () {
        // Kelola Buku & Stok
        Route::resource('buku', BookController::class)->except(['index', 'show'])->names('buku');
        Route::patch('/buku/{book}/stok', [BookController::class, 'updateStock'])->name('buku.update-stock');
        
        // Peminjaman (Full CRUD untuk Pengurus)
        Route::resource('peminjaman', LoanController::class)->except(['index', 'store', 'show'])->names('peminjaman');

        // Kelola Data Master (Rak, Kategori, Penerbit)
        Route::resource('rak', ShelfController::class);
        Route::resource('kategori', CategoryController::class);
        Route::resource('penerbit', PublisherController::class);

        // Sirkulasi & Verifikasi
        Route::get('/persetujuan', [LoanController::class, 'approvals'])->name('admin.persetujuan');
        Route::post('/peminjaman/{loan}/setujui', [LoanController::class, 'approve'])->name('peminjaman.approve');
        Route::post('/peminjaman/{loan}/tolak', [LoanController::class, 'reject'])->name('peminjaman.reject');
        
        Route::get('/daftar-tunggu-admin', [LoanController::class, 'waitlistAdmin'])->name('admin.daftar-tunggu')->middleware('can:access-waitlist');
        Route::delete('/daftar-tunggu/{waitlist}', [LoanController::class, 'destroyWaitlist'])->name('admin.daftar-tunggu.destroy');
    });

    // --- AKSES KHUSUS SUPER ADMIN (SISTEM & AKUN) ---
    Route::middleware(['can:superadmin-only'])->group(function () {
        // Kelola Akun & Role
        Route::resource('pengguna', UserController::class)->names('pengguna');
        Route::post('/pengguna/{user}/setujui', [UserController::class, 'approve'])->name('pengguna.approve');
        
        // Pengaturan Sistem
        Route::get('/pengaturan', [SettingController::class, 'index'])->name('pengaturan.index');
        Route::post('/pengaturan', [SettingController::class, 'update'])->name('pengaturan.update');

        // Monitoring & Laporan Global
        Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [ReportController::class, 'export'])->name('laporan.export');
    });

});


// Approval Wait Page
Route::get('/menunggu-acc', function () {
    return view('auth.approval-wait');
})->middleware('auth')->name('menunggu-acc');

require __DIR__ . '/auth.php';
