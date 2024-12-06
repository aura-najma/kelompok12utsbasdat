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
                'alamat' => 'Jl. Raya Darmo No. 45, Surabaya',
                'hubungi' => 'https://wa.me/6281234567890',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_dokter' => 'Dr. Bambang Yudistira',
                'nomor_str' => 'BY98765432109876',
                'spesialisasi' => 'Spesialis Jantung',
                'alamat' => 'Jl. Tenggilis No. 13, Surabaya',
                'hubungi' => 'https://wa.me/6282345678901',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_dokter' => 'Dr. Citra Lestari',
                'nomor_str' => 'CL1234567890123456',
                'spesialisasi' => 'Spesialis Bedah',
                'alamat' => 'Jl. Tunjungan No. 7, Surabaya',
                'hubungi' => 'https://wa.me/6283456789012',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_dokter' => 'Dr. Dedi Firmansyah',
                'nomor_str' => 'DF456789012345678',
                'spesialisasi' => 'Spesialis THT',
                'alamat' => 'Jl. Cendana No. 10, Surabaya',
                'hubungi' => 'https://wa.me/6284567890123',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_dokter' => 'Dr. Eko Satria',
                'nomor_str' => 'ES234567891011121',
                'spesialisasi' => 'Spesialis Mata',
                'alamat' => 'Jl. Mulyosari No. 19, Surabaya',
                'hubungi' => 'https://wa.me/6285678901234',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_dokter' => 'Dr. Fitri Ayu',
                'nomor_str' => 'FA987654321234567',
                'spesialisasi' => 'Spesialis Kandungan',
                'alamat' => 'Jl. Mangga No. 25, Surabaya',
                'hubungi' => 'https://wa.me/6286789012345',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_dokter' => 'Dr. Gita Kusuma',
                'nomor_str' => 'GK1234567890123456',
                'spesialisasi' => 'Spesialis Kulit',
                'alamat' => 'Jl. Raya Juanda No. 5, Surabaya',
                'hubungi' => 'https://wa.me/6287890123456',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
