<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ApotekerController;



// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for the login page for apoteker
Route::get('/login', function () {
    return view('login');
});

// Route for the pasien page
Route::get('/pasien', function () {
    return view('pasien');
});



// Route for validasi dokter (modif punya wanda)
Route::get('/validasidokter', function () {
    return view('validasidokter');
})->name('validasidokter');

// ke bawah udah lengkap dengan logika

Route::get('/dashboardutama', function () {
    return view('dashboardutama');
})->name('dashboardutama');

Route::get('/inputpasien', function () {
    return view('inputpasien');
})->name('inputpasien');

Route::get('/cekobatkeras', function () {
    return view('cekobatkeras');
})->name('cekobatkeras');

Route::get('/cekstokobat', function () {
    return view('cekstokobat');
})->name('cekstokobat');

Route::get('/checkoutobat', function () {
    return view('checkoutobat');
})->name('checkoutobat');


Route::get('/invoicetransaksi', function () {
    return view('invoicetransaksi');
})->name('invoicetransaksi');


Route::get('/analisispenjualan', function () {
    return view('analisispenjualan');
})->name('analisispenjualan');

Route::get('/evaluasiapotek', function () {
    return view('evaluasiapotek');
})->name('evaluasiapotek');

// bagian dyah
use App\Http\Controllers\DashboardController;

// Route untuk menampilkan form login
Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('login.form');

// Route untuk memproses login
Route::post('/login', [DashboardController::class, 'login'])->name('login');

// Route untuk logout
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

// Route untuk dashboard, dilindungi oleh middleware auth
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'dashboardutama'])->name('dashboard')->middleware('auth');


use App\Http\Controllers\EvaluasiController;

Route::get('/evaluasi', [EvaluasiController::class, 'create'])->name('evaluasi.create');
Route::post('/evaluasi', [EvaluasiController::class, 'store'])->name('evaluasi.store');

use App\Http\Controllers\DokterController;

Route::get('/validasidokter', [DokterController::class, 'index']);

use App\Http\Controllers\InvoiceController;



// bagian aura
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;


// Route untuk menampilkan halaman form pasien dan pembelian
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');

// Route untuk menyimpan data pasien dan pembelian
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');


Route::get('/daftar-pasien/{no_telepon}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
Route::delete('/daftar-pasien/{no_telepon}', [PasienController::class, 'destroy'])->name('pasien.destroy');
Route::put('/daftar-pasien/{no_telepon}', [PasienController::class, 'update'])->name('pasien.update');
Route::get('/daftar-pasien', [PasienController::class, 'listPasien'])->name('daftarPasien');



Route::get('/lihatstokobat', [ObatController::class, 'index']);
Route::post('/getPasienByNoTelepon', [PasienController::class, 'getPasienByNoTelepon'])->name('getPasienByNoTelepon');

Route::get('/get-pasien', [PasienController::class, 'getPasien']);
// Route untuk menampilkan form tambah stok
Route::get('/lihatstokobat/tambah-stok', function () {
    return view('tambahStok'); // Mengarahkan ke resources/views/tambahStok.blade.php
});

// Route untuk memproses penambahan stok
Route::post('/lihatstokobat/tambah-stok', [ObatController::class, 'tambahStok']);
// Route untuk menampilkan form tambah obat
Route::get('/lihatstokobat/tambah-obat', function () {
    return view('tambahObat'); // Mengarahkan ke resources/views/tambahObat.blade.php
});

// Route untuk memproses penambahan obat baru
Route::post('/lihatstokobat/tambah-obat', [ObatController::class, 'tambahObat']);
Route::get('/lihatstokobat/tambah-stok', [ObatController::class, 'showTambahStok'])->name('tambahstok');

// Route untuk cek stok obat
Route::get('/cekstokobat', [ObatController::class, 'cekStok'])->name('cekstokobat');
// Route untuk cek obat keras

use App\Http\Controllers\TransaksiController;

// Route untuk menyimpan transaksi
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

use App\Http\Controllers\ObatKerasController;

// Rute untuk halaman cek obat keras
Route::get('/cekobatkeras', [ObatKerasController::class, 'cekObatKeras'])->name('cekobatkeras');

// Rute untuk memproses cek obat keras (form POST)
Route::post('/cekobatkeras/proses', [ObatKerasController::class, 'prosesCekObatKeras'])->name('prosesCekObatKeras');

// Rute untuk validasi dokter
Route::get('/validasidokter/{id_pembelian}', [DokterController::class, 'index'])->name('validasidokter');

Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/invoicetransaksi', [InvoiceController::class, 'show'])->name('invoice.show');

// Route untuk menampilkan invoice dengan parameter id_pembelian sebagai query string


