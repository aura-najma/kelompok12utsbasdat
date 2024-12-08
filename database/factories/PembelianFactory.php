<?php

namespace Database\Factories;

use App\Models\Pasien;
use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembelianFactory extends Factory
{
    protected $model = Pembelian::class;

    public function definition()
    {
        // Rentang waktu untuk custom_created_at dan custom_updated_at (Januari - September 2024)
        $createdAt = $this->faker->dateTimeBetween('2024-01-01', '2024-09-30')->format('Y-m-d H:i:s');

        // Ambil nomor telepon dari Pasien yang memiliki created_at lebih lama dari $createdAt di Pembelian
        $pasien = Pasien::where('created_at', '<', $createdAt)->pluck('no_telepon')->toArray();

        // Jika tidak ada pasien dengan created_at yang lebih lama, pilih nomor telepon acak
        if (count($pasien) === 0) {
            $noTeleponRandom = $this->faker->phoneNumber; // Jika tidak ada, gunakan nomor acak
        } else {
            $noTeleponRandom = $this->faker->randomElement($pasien); // Ambil nomor telepon yang valid
        }
        $createdAtId = str_replace([':', ' '], '', $createdAt); // Menghapus tanda ":" dan spasi dari createdAt

        // Buat ID Pembelian berdasarkan format yang diinginkan
        $idPembelian = 'PB-' . substr($noTeleponRandom, -4) . '-' . str_replace(['-', ' '], '', $createdAtId); // Mengambil 4 digit terakhir dari nomor telepon dan menggabungkannya dengan tanggal created_at

        // Daftar keluhan berdasarkan kategori obat medis yang relevan
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
        // Logika untuk menentukan apakah ada resep atau tidak
        $resepAda = $this->faker->boolean(50); // 50% kemungkinan untuk ada resep atau tidak
            
        // Jika ada resep, kita tetapkan 'Ada Resep' atau 'Tidak Ada Resep' untuk field resep
        $resep = $resepAda ? 'Ada Resep' : 'Tidak Ada Resep';
        return [
            'no_telepon' => $noTeleponRandom, // Ambil nomor telepon dari tabel pasien
            'keluhan' => $this->faker->randomElement($keluhanList), // Pilih keluhan acak dari daftar medis
            'resep' => $resep, // Resep acak, bisa 'Ada Resep' atau 'Tidak Ada Resep'
            'created_at' => $createdAt, // Waktu created_at yang acak
            'updated_at' => $createdAt, // Sama dengan created_at
            'id_pembelian' => $idPembelian, // ID Pembelian sesuai format
            'custom_created_at' => $createdAt, // Custom created_at
            'custom_updated_at' => $createdAt, // Custom updated_at
        ];
    }
}
