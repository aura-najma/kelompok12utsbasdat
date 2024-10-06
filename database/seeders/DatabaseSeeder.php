<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jika ingin men-generate 10 user secara random
        // User::factory(10)->create();

        // Membuat satu user dengan data khusus
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Panggil seeder apoteker untuk mengisi tabel apoteker
        $this->call(ApotekerSeeder::class);
    }
}
