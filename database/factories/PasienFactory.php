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
            'Alam', 'Bakti', 'Cahya', 'Darma', 'Fajar', 'Gema', 'Hutama', 'Indra', 'Jaya', 'Kusuma', 'Mahardika', 'Nugraha', 'Pratama', 'Santosa', 'Sakti', 'Sutrisno', 'Wibowo', 'Kartawiharja', 'Yudistira', 'Tanadi', 'Pramana', 'Wijaya', 'Sudirman', 'Amin', 'Kurnia', 'Mukti', 'Angkasa', 'Samudra'
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

        // Tentukan jenis kelamin terlebih dahulu
        $jenisKelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);

        return [
            // No telepon yang formatnya untuk Indonesia
            'no_telepon' => '08' . $faker->randomNumber(8, true),  // No telepon Indonesia

            // Nama pasien acak dari nama depan dan belakang
            'nama' => function() use ($faker, $namaDepanPria, $namaDepanWanita, $namaBelakang, $jenisKelamin) {
                // Tentukan nama depan berdasarkan jenis kelamin
                $namaDepan = ($jenisKelamin === 'Laki-laki') ? $faker->randomElement($namaDepanPria) : $faker->randomElement($namaDepanWanita);

                // Gabungkan nama depan dengan nama belakang
                return $namaDepan . ' ' . $faker->randomElement($namaBelakang);
            },

            // Jenis kelamin sesuai dengan yang sudah ditentukan
            'jenis_kelamin' => $jenisKelamin,  // Jenis kelamin

            // Tanggal lahir dengan umur antara 17 - 60 tahun
            'tanggal_lahir' => $faker->dateTimeBetween('-60 years', '-17 years')->format('Y-m-d'),

            // Alamat sesuai dengan kecamatan yang acak
            'alamat' => $alamat,  

            // ID Kecamatan acak antara KC-1 sampai KC-31
            'ID_Kecamatan' => $idKecamatan,  

            // Alergi obat acak dari daftar alergi obat
            'alergi_obat' => $faker->boolean(50) ? $faker->randomElement($obatAlergi) : null,

            // Waktu created_at antara awal 2023 sampai 6 bulan pertama 2024
            'created_at' => $faker->dateTimeBetween('2023-10-01', '2024-09-30')->format('Y-m-d H:i:s'),

            // Waktu updated_at yang akan di-set sama dengan created_at
            'updated_at' => now(),
        ];
    }
}
