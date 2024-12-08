<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembelian;
use Faker\Factory as Faker;

class PembelianSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Initialize the Faker instance

        // Periode 1: Januari - Maret 2024
        Pembelian::factory(300)->create([
            'created_at' => $faker->dateTimeBetween('2024-01-01', '2024-03-31')->format('Y-m-d H:i:s'),
        ]);

        // Periode 2: April - Juni 2024
        Pembelian::factory(300)->create([
            'created_at' => $faker->dateTimeBetween('2024-04-01', '2024-06-30')->format('Y-m-d H:i:s'),
        ]);

        // Periode 3: Juli - September 2024
        Pembelian::factory(300)->create([
            'created_at' => $faker->dateTimeBetween('2024-07-01', '2024-09-30')->format('Y-m-d H:i:s'),
        ]);
    }
}
