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

// Route for pasien pasien2
Route::get('/pasien2', function () {
    return view('pasien2');
})->name('pasien2');

// Route for inputdata
Route::get('/inputdata', function () {
    return view('inputdata');
})->name('inputdata');

// Route for obat
Route::get('/obat', function () {
    return view('obat');
})->name('obat');

// Route for cekout
Route::get('/cekout', function () {
    return view('cekout');
})->name('cekout');

// Route for eval
Route::get('/eval', function () {
    return view('eval');
})->name('eval');

// Route for invoice
Route::get('/invoice', function () {
    return view('invoice');
})->name('invoice');

Route::get('/welcome2', function () {
    return view('welcome2');
})->name('welcome2');

Route::get('/login2', function () {
    return view('login2');
})->name('login2');

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

Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('login');
Route::post('/login', [DashboardController::class, 'login']);
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');


// bagian aura
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;


// Route untuk menampilkan halaman form pasien dan pembelian
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');

// Route untuk menyimpan data pasien dan pembelian
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');

// Route untuk mengambil data pasien lama berdasarkan no_telepon (AJAX)


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