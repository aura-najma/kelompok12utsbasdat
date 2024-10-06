<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('dokter')->insert([
            [
                'nama_dokter' => 'Dr. Andi Saputra',
                'nomor_str' => 'AS12345678901234',
                'spesialisasi' => 'Spesialis Anak',
                'alamat' => 'Jl. Kenanga No. 23, Surabaya',
                'hubungi' => 'https://wa.me/6281234567890',
            ],
            [
                'nama_dokter' => 'Dr. Bambang Yudistira',
                'nomor_str' => 'BY98765432109876',
                'spesialisasi' => 'Spesialis Jantung',
                'alamat' => 'Jl. Mawar No. 7, Gresik',
                'hubungi' => 'https://wa.me/6289876543210',
            ],
            [
                'nama_dokter' => 'Dr. Citra Lestari',
                'nomor_str' => 'CL1234567890123456',
                'spesialisasi' => 'Spesialis Bedah',
                'alamat' => 'Jl. Kamboja No. 2, Surabaya',
                'hubungi' => 'https://wa.me/6282345678901',
            ],
            [
                'nama_dokter' => 'Dr. Dedi Firmansyah',
                'nomor_str' => 'DF456789012345678',
                'spesialisasi' => 'Spesialis THT',
                'alamat' => 'Jl. Cendana No. 10, Malang',
                'hubungi' => 'https://wa.me/6283456789012',
            ],
            [
                'nama_dokter' => 'Dr. Eko Satria',
                'nomor_str' => 'ES234567891011121',
                'spesialisasi' => 'Spesialis Mata',
                'alamat' => 'Jl. Melati No. 12, Surabaya',
                'hubungi' => 'https://wa.me/6284567890123',
            ],
            [
                'nama_dokter' => 'Dr. Fitri Ayu',
                'nomor_str' => 'FA987654321234567',
                'spesialisasi' => 'Spesialis Kandungan',
                'alamat' => 'Jl. Mangga No. 15, Sidoarjo',
                'hubungi' => 'https://wa.me/6285678901234',
            ],
        ]);
    }
}
