<?php

namespace Database\Factories;

use App\Models\Pasien;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    protected $model = Pasien::class;

    public function definition()
    {
        // Inisialisasi Faker
        $faker = \Faker\Factory::create();

        // Nama-nama Indonesia campuran Jawa dan Barat (Male and Female)
        $namaDepanPria = [
            'Ahmad', 'Bima', 'Daniel', 'Fahri', 'Gilang', 'Hassan', 'Irfan', 'Jamal', 'Kevin', 'Lutfi', 'Mikael', 'Naufal', 'Omar', 'Pandu', 'Rafael', 'Rizal', 'Satria', 'Taufik', 'Yusuf', 'Zidan'
        ];

        $namaDepanWanita = [
            'Alya', 'Bella', 'Cinta', 'Dina', 'Eliza', 'Farah', 'Gita', 'Hana', 'Intan', 'Jihan', 'Kartika', 'Laila', 'Mira', 'Nabila', 'Putri', 'Rania', 'Siti', 'Tara', 'Ulya', 'Vina', 'Wulan', 'Yuni', 'Zahra', 'Amira', 'Nisa', 'Fira'
        ];

        $namaBelakang = [
            'Alam', 'Bakti', 'Cahya', 'Darma', 'Fajar', 'Gema', 'Hutama', 'Indra', 'Jaya', 'Kusuma', 'Mahardika', 'Nugraha', 'Pratama', 'Santosa', 'Sakti', 'Sutrisno', 'Wibowo', 'Putra', 'Arif', 'Hadi', 'Nusantara', 'Pramana', 'Wijaya', 'Sudirman', 'Amin', 'Rama', 'Budi', 'Jati', 'Kurnia', 'Wira', 'Mukti', 'Angkasa', 'Dwi', 'Samudra'
        ];

        // Alergi Obat yang relevan
        $obatAlergi = [
            'Paracetamol', 'Ibuprofen', 'Amoksisilin', 'Penicillin', 'Aspirin', 'Cetirizine', 'Loratadine',
            'Dexamethasone', 'Chlorpheniramine', 'Prednisone', 'Metformin', 'Losartan', 'Atorvastatin',
            'Simvastatin', 'Lisinopril', 'Diazepam', 'Furosemide', 'Ranitidine', 'Omeprazole'
        ];

        // Mendapatkan kecamatan berdasarkan ID_Kecamatan
        $kecamatan = Kecamatan::pluck('Kecamatan', 'ID_Kecamatan')->toArray();

        // Mengambil ID Kecamatan yang acak
        $idKecamatan = $faker->randomElement(array_keys($kecamatan));

        // Membuat alamat sesuai dengan kecamatan
        $alamat = 'Jl. ' . $kecamatan[$idKecamatan] . ' No. ' . $faker->numberBetween(1, 100);

        return [
            // No telepon yang formatnya untuk Indonesia
            'no_telepon' => '08' . $faker->randomNumber(8, true),  // No telepon Indonesia

            // Nama pasien acak dari nama depan dan belakang
            'nama' => $faker->randomElement($faker->randomElement(['male' => $namaDepanPria, 'female' => $namaDepanWanita])) . ' ' . $faker->randomElement($namaBelakang),  // Nama lengkap Indonesia

            // Jenis kelamin acak
            'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),  // Jenis kelamin

            // Tanggal lahir dengan umur antara 17 - 60 tahun
            'tanggal_lahir' => $faker->dateTimeBetween('-60 years', '-17 years')->format('Y-m-d'),

            // Alamat sesuai dengan kecamatan yang acak
            'alamat' => $alamat,  

            // ID Kecamatan acak antara KC-1 sampai KC-31
            'ID_Kecamatan' => $idKecamatan,  

            // Alergi obat acak dari daftar alergi obat
            'alergi_obat' => $faker->boolean(50) ? $faker->randomElement($obatAlergi) : null,

            // Waktu created_at antara awal 2023 sampai 6 bulan pertama 2024
            'created_at' => $faker->dateTimeBetween('2023-01-01', '2024-06-30')->format('Y-m-d H:i:s'),

            // Waktu updated_at yang akan di-set sama dengan created_at
            'updated_at' => now(),
        ];
    }
}
