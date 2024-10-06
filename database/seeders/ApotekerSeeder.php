<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApotekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apoteker')->insert([
            [
                'NIP' => 1,
                'password' => Hash::make('katak'), // Hashing the password for security
                'user' => 'Dyah Ayu',
                'no_hp' => '082335467428',
                'email' => 'dyahayu@gmail.com',
                'alamat' => 'Jl Sutorejo 17 Mulyorejo Surabaya',
                'jam_kerja' => '07.00 - 12.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NIP' => 2,
                'password' => Hash::make('kupu'), // Hashing the password for security
                'user' => 'Aura Najma',
                'no_hp' => '082335460029',
                'email' => 'auranajma@gmail.com',
                'alamat' => 'Jl Sutorejo 16 Mulyorejo Surabaya',
                'jam_kerja' => '12.00 - 17.00',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
