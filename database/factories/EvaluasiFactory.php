<?php

namespace Database\Factories;

use App\Models\Pasien;
use App\Models\Transaksi; 
use App\Models\Evaluasi; // Pastikan model Transaksi diimport
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

class EvaluasiFactory extends Factory
{
    protected $model = Evaluasi::class;

    public function definition()
    {
        // Inisialisasi Faker
        $faker = \Faker\Factory::create();

        // Daftar nilai untuk evaluasi dan komentar
        $evaluasiOptions = ['Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'];
        $komentarOptions = ['baik', '-', 'sip', 'mantap', 'perlu diperbaiki', 'overall oke tingkatkan terus', 'sangat jelek', 'apotek aneh'];

        // Ambil ID invoice dan tanggal transaksi acak dari tabel transaksis
        $transaksi = Transaksi::inRandomOrder()->first(); // Mengambil transaksi acak
        $id_invoice = $transaksi->id_invoice ; // Ambil ID invoice dari tabel transaksi
        $tanggal_transaksi = $transaksi->created_at ; // Ambil tanggal transaksi dari tabel transaksis atau gunakan waktu sekarang jika tidak ada transaksi

        // Mengatur created_at untuk diacak antara tanggal transaksi, tanggal transaksi +1, atau tanggal transaksi +2
        $createdAt = Carbon::parse($tanggal_transaksi)->addDays(rand(0, 2)); // Tambahkan 0, 1, atau 2 hari

        // Return data dummy
        return [
            'id_invoice' => $id_invoice, // Menggunakan ID invoice dari tabel transaksis
            'tanggal_transaksi' => $tanggal_transaksi, // Menggunakan tanggal transaksi dari tabel transaksis
            'evaluasi_apotek' => $faker->randomElement($evaluasiOptions),
            'evaluasi_pelayanan' => $faker->randomElement($evaluasiOptions),
            'evaluasi_obat' => $faker->randomElement($evaluasiOptions),
            'rating_apotek' => $faker->numberBetween(1, 10), // Rating acak 1-10
            'komentar' => $faker->randomElement($komentarOptions),
            'created_at' => $createdAt, // Menggunakan created_at yang diacak
            'updated_at' => $createdAt, // Set updated_at sama dengan created_at
            'id_evaluasi' => $faker->uuid(),
            'evaluasi_dibuat' => null,
            'evaluasi_diperbarui' => null,
        ];
    }
}
