<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ApotekerController;



// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for login page for apoteker
//Route::get('/login', function () {
  //  return view('login');
//})->name('login');

// Route for pasien pasien
Route::get('/pasien', function () {
    return view('pasien');
})->name('pasien');

/*
// Route for the registration form
Route::get('/form', [RegistrationController::class, 'showForm'])->name('form.show');
Route::post('/form', [RegistrationController::class, 'submitForm'])->name('form.submit');

// Route for input data page
Route::get('/input-data', [RegistrationController::class, 'inputData'])->name('data.input');

// Route for beranda2 page
Route::get('/beranda2', [RegistrationController::class, 'beranda2'])->name('beranda2');
*/
// views aja


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

Route::get('/validasi-dokter', [DokterController::class, 'index'])->name('validasi.dokter');


// bagian aura
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;


// Route untuk menampilkan halaman form pasien dan pembelian
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');

// Route untuk menyimpan data pasien dan pembelian
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');


Route::get('/daftar-pasien', [PasienController::class, 'listPasien']);



Route::get('/lihatstokobat', [ObatController::class, 'index']);

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

// Route untuk cek stok obat
Route::get('/cekstokobat', [ObatController::class, 'cekStok'])->name('cekstokobat');
// Route untuk cek obat keras
Route::get('/cekobatkeras', [ObatController::class, 'cekObatKeras'])->name('cekobatkeras');

use App\Http\Controllers\TransaksiController;

// Route untuk menyimpan transaksi
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
