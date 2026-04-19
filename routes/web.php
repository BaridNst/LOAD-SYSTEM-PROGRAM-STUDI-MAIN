<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

// 1. Langsung ke Login agar sistem langsung meminta autentikasi
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Grup Fitur Utama (Semua harus login terlebih dahulu)
Route::middleware(['auth', 'verified'])->group(function () {
    // Route untuk Admin menyetujui atau menolak pinjaman
Route::post('/admin/setujui/{id}', [InventoryController::class, 'setujuiPinjaman'])->name('admin.setujui');
Route::post('/admin/tolak/{id}', [InventoryController::class, 'tolakPinjaman'])->name('admin.tolak');
    
    // Dashboard: Menampilkan Tabel Daftar Barang & Riwayat Peminjaman
    Route::get('/dashboard', [InventoryController::class, 'index'])->name('dashboard');

    // Fitur Peminjaman: Pinjam, Kembalikan, dan Bersihkan Riwayat
    Route::post('/pinjam/{id}', [InventoryController::class, 'pinjam'])->name('pinjam.barang');
    Route::post('/kembali/{id}', [InventoryController::class, 'kembali'])->name('kembali.barang');
    Route::post('/bersihkan-riwayat', [InventoryController::class, 'bersihkanRiwayat'])->name('riwayat.bersihkan');

    // Fitur Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Inventaris: Kelola data master barang (Tambah, Edit, Hapus)
    Route::resource('inventories', InventoryController::class);
});

require __DIR__.'/auth.php';