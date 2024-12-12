<?php

namespace Database\Factories;

use App\Models\Pembelian;
use App\Models\Pasien;
use App\Models\Apoteker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;

class PembelianFactory extends Factory
{
    protected $model = Pembelian::class;

    public function definition()
    {
        // Rentang tanggal custom_created_at dari Januari hingga September 2024
        $customCreatedAt = $this->faker->dateTimeBetween('2024-01-01', '2024-09-30');
        
        // Mengambil semua pasien yang created_at-nya lebih kecil dari custom_created_at
        $pasien = Pasien::where('created_at', '<', $customCreatedAt)->get();

        // Memastikan ada pasien yang ditemukan
        if ($pasien->isEmpty()) {
            throw new \Exception("Tidak ada pasien yang memenuhi kriteria.");
        }

        // Memilih pasien secara acak dari hasil query yang telah diambil
        $randomPasien = $pasien->random();

        // Membuat id_pembelian dengan format PB-<4_digit_terakhir_no_telepon>-<custom_created_at_in_format_YmdHi>
        $idPembelian = 'PB-' . substr($randomPasien->no_telepon, -4) . '-' . Carbon::parse($customCreatedAt)->format('YmdHi');

        // Daftar keluhan yang telah diberikan
        $keluhanList = [
            // Batuk & Pilek
            'Batuk dan pilek', 
            'Hidung tersumbat dan batuk kering',
            'Batuk berdahak',
            'Pilek dan sesak napas',
            
            // Flu, Pusing, dan Demam
            'Flu dan demam tinggi',
            'Pusing dan lemas',
            'Demam disertai nyeri tubuh',
            'Mual, pusing, dan demam',
            
            // Gangguan dan Perawatan Kulit
            'Ruam kulit dan gatal-gatal',
            'Kulit kering dan mengelupas',
            'Penyakit kulit berjerawat',
            'Iritasi dan alergi kulit',
            
            // Gangguan Nyeri dan Pereda Sakit
            'Nyeri sendi dan otot',
            'Nyeri kepala dan migrain',
            'Nyeri punggung bawah',
            'Nyeri perut dan kram',
            
            // Gangguan Pencernaan
            'Mual dan muntah',
            'Perut kembung dan sembelit',
            'Diare dan sakit perut',
            'Sakit maag dan perut mulas',
            
            // Mata
            'Iritasi mata dan mata merah',
            'Penglihatan kabur dan mata lelah',
            'Sakit mata dan sensitif terhadap cahaya',
            'Penyakit mata seperti konjungtivitis',
            
            // THT (Telinga, Hidung, Tenggorokan)
            'Sakit tenggorokan dan batuk',
            'Telinga terasa sakit dan berdenging',
            'Hidung tersumbat dan sakit kepala',
            'Telinga sakit dan flu',
        ];

        // Pilih keluhan secara acak dari list
        $keluhan = $this->faker->randomElement($keluhanList);

        // Logika untuk menentukan apakah ada resep atau tidak
        $resepAda = $this->faker->boolean(50); // 50% kemungkinan untuk ada resep atau tidak
        $resep = $resepAda ? 'Ada Resep' : 'Tidak Ada Resep'; // Tentukan nilai untuk field resep

        // Ambil NIP apoteker secara acak dari tabel apoteker
        $apoteker = Apoteker::inRandomOrder()->first();

        if ($apoteker) {
            $nip = $apoteker->NIP;
        } else {
            // Menangani jika tidak ada apoteker
            throw new \Exception("Tidak ada apoteker yang tersedia.");
        }
        
        return [
            'id_pembelian' => $idPembelian, // ID pembelian sesuai format yang diinginkan
            'no_telepon' => $randomPasien->no_telepon, // Nomor telepon dari pasien yang sesuai
            'keluhan' => $keluhan, // Pilih keluhan secara acak dari list
            'resep' => $resep, // Tentukan apakah ada resep atau tidak
            'custom_created_at' => $customCreatedAt,
            'custom_updated_at' => $customCreatedAt,

            'nip' => $nip, // Tambahkan NIP apoteker yang ditangani pembelian ini

            // Kosongkan created_at dan updated_at
            'created_at' => null,
            'updated_at' => null,
        ];
    }
}
