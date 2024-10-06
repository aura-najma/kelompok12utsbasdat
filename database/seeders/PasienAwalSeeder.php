<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pasiens')->insert([
            [
                'no_telepon' => '0812222992930',
                'nama' => 'Naya Andina',
                'tanggal_lahir' => '2001-06-13',
                'alamat' => 'Jalan Menur Pumpungan No 15',
                'alergi_obat' => null,
                'created_at' => '2024-10-05 10:20:39',
                'updated_at' => '2024-10-05 10:20:39',
            ],
            [
                'no_telepon' => '081245245245',
                'nama' => 'Manisa Zahra Adinda',
                'tanggal_lahir' => '2002-02-02',
                'alamat' => 'Jalan Sutorejo Tengah VIA No 12',
                'alergi_obat' => null,
                'created_at' => '2024-10-06 03:09:01',
                'updated_at' => '2024-10-06 03:09:01',
            ],
            [
                'no_telepon' => '08133253202555',
                'nama' => 'Haidar Bakti Perdana',
                'tanggal_lahir' => '2003-09-09',
                'alamat' => 'Jalan Dharmusada Timur Indah Blok V No 21',
                'alergi_obat' => 'Panadol',
                'created_at' => '2024-10-04 15:43:22',
                'updated_at' => '2024-10-05 14:52:41',
            ],
            [
                'no_telepon' => '08133253206666',
                'nama' => 'Nasiha',
                'tanggal_lahir' => '2002-02-02',
                'alamat' => 'Jalan Menur Pumpungan no 12',
                'alergi_obat' => null,
                'created_at' => '2024-10-06 03:21:01',
                'updated_at' => '2024-10-06 03:21:01',
            ],
            [
                'no_telepon' => '08144455562830',
                'nama' => 'Marina Sabila',
                'tanggal_lahir' => '2002-12-12',
                'alamat' => 'Jalan Dharmahusada Indah Barat Blok B12 Nomor 12E',
                'alergi_obat' => 'Ibuprofen',
                'created_at' => '2024-10-04 11:43:21',
                'updated_at' => '2024-10-04 11:43:21',
            ],
            [
                'no_telepon' => '0814445556666',
                'nama' => 'Sarah Aulia Putri',
                'tanggal_lahir' => '2005-02-10',
                'alamat' => 'Jalan Kendangsari Blok B-2 No 3',
                'alergi_obat' => 'Zizal',
                'created_at' => '2024-10-04 05:44:48',
                'updated_at' => '2024-10-04 05:44:48',
            ],
            [
                'no_telepon' => '082347545740',
                'nama' => 'Arya Zakky Madani',
                'tanggal_lahir' => '1990-06-06',
                'alamat' => 'Wisma Permai Blok 3B No 4',
                'alergi_obat' => null,
                'created_at' => '2024-10-05 02:53:57',
                'updated_at' => '2024-10-05 02:53:57',
            ],
            [
                'no_telepon' => '087678374329',
                'nama' => 'Hanif',
                'tanggal_lahir' => '2006-09-03',
                'alamat' => 'Jalan Jemursari Tengah XII no 12',
                'alergi_obat' => null,
                'created_at' => '2024-10-05 02:49:57',
                'updated_at' => '2024-10-05 02:49:57',
            ],
            [
                'no_telepon' => '0876834894950',
                'nama' => 'Azizah Salamah',
                'tanggal_lahir' => '2000-03-10',
                'alamat' => 'Jalan Manyar Tirtomoyo Gang Buntu Nomor 4A',
                'alergi_obat' => null,
                'created_at' => '2024-10-05 02:45:35',
                'updated_at' => '2024-10-05 02:45:35',
            ],
            [
                'no_telepon' => '08900034894950',
                'nama' => 'Nahla',
                'tanggal_lahir' => '2005-02-02',
                'alamat' => 'Jalan Manyar Asri Blok B4 No 7',
                'alergi_obat' => 'Panadol',
                'created_at' => '2024-10-04 05:44:48',
                'updated_at' => '2024-10-04 05:44:48',
            ],
        ]);
    }
}