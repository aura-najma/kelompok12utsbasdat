<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatKerasController extends Controller
{
    /**
     * Menampilkan halaman cek obat keras.
     */
    public function cekObatKeras($idPembelian)
    {
        // Mengambil semua nama obat dari tabel obats
        $daftarObat = Obat::pluck('nama')->toArray();

        // Mengambil semua obat yang termasuk kategori 'Obat Keras'
        $obatKeras = Obat::where('jenis_obat', 'Keras')->pluck('nama')->toArray();

        // Debugging: Melihat daftar obat dan obat keras
        dump($daftarObat);
        dump($obatKeras);
        dump($idPembelian);

        // Mengirim data ke view cekobatkeras
        return view('cekobatkeras', [
            'daftarObat' => $daftarObat,
            'obatKeras' => $obatKeras,
            'idPembelian' => $idPembelian,
        ]);
    }

    /**
     * Memproses validasi dari form cek obat keras.
     */
    public function prosesCekObatKeras(Request $request)
    {
        // Mengambil input dari request
        $namaObatList = $request->input('nama_obat', []); // Ambil semua nama obat dari input form (bisa kosong)
        $idPembelian = $request->input('id_pembelian');

        // Debugging: Melihat input dari pengguna
        dump($namaObatList);
        dump($idPembelian);

        // Cek setiap obat dalam daftar input
        $obatKerasDitemukan = [];
        foreach ($namaObatList as $namaObat) {
            if (trim($namaObat) === '') {
                // Jika input kosong, lanjutkan ke input berikutnya
                continue;
            }

            // Cek apakah obat yang dipilih termasuk kategori 'Obat Keras'
            $obat = Obat::where('nama', $namaObat)->first();

            // Debugging: Melihat obat yang ditemukan di database
            dump($obat);

            if ($obat && $obat->kategori === 'Obat Keras') {
                $obatKerasDitemukan[] = $namaObat;
            }
        }

        // Debugging: Melihat daftar obat keras yang ditemukan
        dump($obatKerasDitemukan);

        // Jika ada obat keras yang ditemukan
        if (!empty($obatKerasDitemukan)) {
            return redirect('/validasidokter/' . $idPembelian)
                ->with('warning', 'Obat-obat berikut adalah Obat Keras: ' . implode(', ', $obatKerasDitemukan) . '. Lanjutkan untuk validasi dokter.');
        }

        // Jika tidak ada obat keras yang ditemukan
        return redirect()->back()->with('success', 'Tidak ada obat keras yang ditemukan.');
    }
}
