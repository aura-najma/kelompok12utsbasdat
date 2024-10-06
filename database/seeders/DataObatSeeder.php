<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('obats')->insert([
            [
                'no_bpom' => 'DTL1504523110A1',
                'nama' => 'Neozep Strip 4 Tablet',
                'kategori' => 'Batuk & Pilek',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-21',
                'harga_satuan' => 3200,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa (1 tablet, 3-4 kali sehari), Anak 6-12 tahun (1/2 tablet, 3-4 kali sehari)',
                'aturan_pakai' => 'Sesudah Makan',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'GTL9832301029A1',
                'nama' => 'Miconazole 2% Cream 10 gr KF',
                'kategori' => 'Gangguan & Perawatan Kulit',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-09',
                'harga_satuan' => 5800,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Oleskan Miconazole 2% Cream 10 gr KF pada bagian kulit yang terinfeksi, 2 kali sehari, pada pagi dan malam hari, selama 2 minggu atau sesuai petunjuk dokter.',
                'aturan_pakai' => 'Gunakan di pagi dan malam hari setelah mencuci tangan dan jangan tutup area yang sudah diolesi kecuali atas anjuran dokter',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'DBL7221628958A1',
                'nama' => 'Microlax 5 ml',
                'kategori' => 'Pencernaan',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-21',
                'harga_satuan' => 24200,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa dan Anak >3 Tahun: 1 tube 1 kali hingga BAB lancar.',
                'aturan_pakai' => 'Tekan tube hingga isi obat keluar sedikit, mengoleskan obat di seluruh permukaan pipa/kanula dengan tangan yang bersih, dan masukkan pipa ke dubur perlahan hingga isinya keluar',
                'rute_obat' => 'Rektal',
            ],
            [
                'no_bpom' => 'DTL9222212604A1',
                'nama' => 'Tuzalos Strip 4 Tablet',
                'kategori' => 'Batuk & Pilek',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-01-10',
                'harga_satuan' => 6000,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa (1 kaplet, 3 kali per hari). Anak-anak 6-12 tahun (½ kaplet, 3 kali per hari)',
                'aturan_pakai' => 'Menggunakan obat sesuai dosis dan/atau petunjuk dokter, telan obat utuh dengan air putih, bisa dikonsumsi dengan atau tanpa makanan, pastikan jarak antar dosis cukup',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DBL7204116137A1',
                'nama' => 'OBH Combi Batuk Berdahak Menthol 7.5 ml Sachet',
                'kategori' => 'Batuk & Pilek',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-15',
                'harga_satuan' => 1300,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Anak usia 6 - 12 tahun (3 kali sehari 1.5 sendok takar @ 7.5 ml), Dewasa (3 kali sehari 3 sendok takar @15 ml)',
                'aturan_pakai' => 'Sesudah Makan',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DKL0111633037A1',
                'nama' => 'Woods Antitussive Syrup 100 ml',
                'kategori' => 'Batuk & Pilek',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-19',
                'harga_satuan' => 41400,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa dan anak > 12 tahun (10 ml, 3 kali sehari), anak-anak 6-12 tahun (5 ml, 3 kali sehari)',
                'aturan_pakai' => 'Sesudah Makan',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DBL9111601963A1',
                'nama' => 'Promag Strip 10 Tablet',
                'kategori' => 'Pencernaan',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-22',
                'harga_satuan' => 9600,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa (1-2 tablet, 3-4 kali sehari), Anak 6-12 tahun (1/2-1 tablet, 3-4 kali sehari)',
                'aturan_pakai' => 'Segera diminum saat timbul gejala, dilanjutkan 1-2 jam sebelum/sesudah makan dan sebelum tidur.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DTL9424502404A1',
                'nama' => 'Panadol Cold & Flu Strip 10 Tablet',
                'kategori' => 'Flu, Pusing & Demam',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-20',
                'harga_satuan' => 18100,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dosis Dewasa (1 kaplet tiap 4-6 jam sehari dengan maksimal 8 kaplet/hari)',
                'aturan_pakai' => 'Bersama Makanan',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DBL1124403137A1',
                'nama' => 'Tempra Grape Syrup 60 ml',
                'kategori' => 'Flu, Pusing & Demam',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-14',
                'harga_satuan' => 55500,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Untuk anak di bawah 2 tahun, gunakan Tempra Drops sesuai anjuran dokter. Anak usia 2-3 tahun: 5 ml, usia 4-5 tahun: 7.5 ml, usia 6 tahun: 10 ml, dan di atas 6 tahun gunakan Tempra Forte. Berikan obat setiap 4 jam, maksimal 5 kali sehari.',
                'aturan_pakai' => 'Gunakan sesuai dosis dan kocok dulu, gunakan sendok takar dalam kemasan, dapat dikonsumsi sebelum/sesudah makan. Bisa dikonsumsi dengan air/susu/jus buah agar lebih mudah tertelan.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DTL7813003810A1',
                'nama' => 'Paramex Strip 4 Tablet',
                'kategori' => 'Flu, Pusing & Demam',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-15',
                'harga_satuan' => 2900,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dosis Dewasa: 1 tablet, 2-3 kali sehari.',
                'aturan_pakai' => 'Sesudah Makan',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DKL9815612937A1',
                'nama' => 'Mucos Syrup 60 ml',
                'kategori' => 'Flu, Pusing & Demam',
                'jenis_obat' => 'Keras',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-10',
                'harga_satuan' => 22500,
                'kategori_obat_keras' => 'C',
                'dosis' => 'Dewasa dan anak >12 tahun: 10 ml, 2 kali sehari. Anak 6-11 tahun: 5 ml, 2-3 kali sehari. Anak 2-5 tahun: 2.5 ml, 3 kali sehari. Anak <2 tahun: 2.5 ml, 2 kali sehari.',
                'aturan_pakai' => 'Selalu ikuti dosis dan petunjuk dokter. Konsumsi obat bersama makanan dan gunakan sendok takar yang tersedia untuk dosis tepat. Pastikan jarak waktu penggunaan cukup, dan jangan ubah dosis tanpa persetujuan dokter.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DKI0087100256A1',
                'nama' => 'Nasonex Nasal Spray 60 Dosis',
                'kategori' => 'Flu, Pusing & Demam',
                'jenis_obat' => 'Keras',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-01-29',
                'harga_satuan' => 308300,
                'kategori_obat_keras' => 'C',
                'dosis' => 'Untuk rhinitis alergi, dewasa dan remaja: 2 semprotan per lubang hidung, 1 kali sehari. Dosis pemeliharaan: 1 semprotan per lubang hidung. Maksimal: 4 semprotan per lubang hidung. Anak 2-11 tahun: 1 semprotan per lubang hidung, 1 kali sehari.',
                'aturan_pakai' => 'Ikuti dosis dan petunjuk dokter. Cuci tangan dan bersihkan hidung sebelum pemakaian. Semprot ke lubang hidung sambil menarik napas. Bersihkan ujung botol dan tutup kembali. Jangan berbagi botol, ubah dosis, atau gunakan lebih lama tanpa izin dokter.',
                'rute_obat' => 'Nasal',
            ],
            [
                'no_bpom' => 'DKL9232000537A1',
                'nama' => 'Ventolin Syrup 100 ml',
                'kategori' => 'Asma',
                'jenis_obat' => 'Keras',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-01-16',
                'harga_satuan' => 88500,
                'kategori_obat_keras' => 'C',
                'dosis' => 'Dosis Ventolin Sirup: Dewasa: 4 mg, 3-4 kali sehari, dapat ditingkatkan hingga 8 mg jika perlu. Anak 2-6 tahun: 1-2 mg, 3-4 kali sehari (1 mg bisa dipertimbangkan). Anak 6-12 tahun: 2 mg, 3-4 kali sehari; usia >12 tahun: 2-4 mg, 3-4 kali sehari.',
                'aturan_pakai' => 'Gunakan obat sesuai anjuran dokter dan konsumsi setelah makan. Gunakan sendok takar untuk dosis akurat. Minum obat pada waktu yang sama setiap hari dan jangan ubah dosis tanpa konsultasi dokter. Jika lupa minum, konsumsi tanpa menggandakan dosis.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DBL1940404763A1',
                'nama' => 'Disflatyl 40 mg Strip 10 Tablet',
                'kategori' => 'Pencernaan',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-19',
                'harga_satuan' => 6300,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => '2 tablet sebanyak 3 kali/hari. Sesuai dengan aturan penggunaan atau berdasarkan resep dokter.',
                'aturan_pakai' => 'Digunakan setelah makan atau sebelum tidur dengan cara dikunyah.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'QD151213441',
                'nama' => 'Herocyn Powder 85 gr',
                'kategori' => 'Gangguan & Perawatan Kulit',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-21',
                'harga_satuan' => 15200,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Gunakan secukupnya setelah mandi.',
                'aturan_pakai' => 'Taburkan bedak secukupnya di telapak tangan. Gosokkan ke bagian kulit yang ingin diobati setelah mandi.',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'QD151713251',
                'nama' => 'Kalpanax Salep 6 gr',
                'kategori' => 'Gangguan & Perawatan Kulit',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-08',
                'harga_satuan' => 10200,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Sesuai kebutuhan, 2 kali sehari. Lama penggunaan bervariasi tergantung kondisi infeksi yang dialami. Umumnya antara 2 minggu.',
                'aturan_pakai' => 'Dioleskan tipis-tipis pada bagian tubuh yang terinfeksi saat sudah kering. Jangan lupa mencuci tangan sebelum dan sesudah menggunakan obat. Cuci dan keringkan area yang mengalami infeksi jamur sebelum diobati dengan obat ini.',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'DTL8526103028A1',
                'nama' => 'Thrombophob Gel 20 gr',
                'kategori' => 'Gangguan & Perawatan Kulit',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-19',
                'harga_satuan' => 73000,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Oleskan pada kulit yang memiliki gejala 2-3 kali per hari.',
                'aturan_pakai' => 'Gunakan sesuai aturan yang tertera pada kemasan atau petunjuk dokter. Bersihkan kulit yang akan diobati, kemudian oleskan Thrombophob secara tipis dan merata pada area tersebut.',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'DBL9615806416A1',
                'nama' => 'Neurobion Forte 5000 Strip 10 Tablet',
                'kategori' => 'Gangguan Nyeri dan Pereda Sakit',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-06',
                'harga_satuan' => 47900,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa: 1 tablet, 1 kali per hari atau sesuai dengan anjuran dokter.',
                'aturan_pakai' => 'Dikonsumsi sesudah makan. Konsumsi tablet secara utuh jangan dikunyah atau dihancurkan.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DTL7813004710A1',
                'nama' => 'Feminax Pereda Nyeri Haid Strip 4 Tablet',
                'kategori' => 'Gangguan Nyeri dan Pereda Sakit',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-09',
                'harga_satuan' => 3700,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa: 3 kali sehari 1-2 tablet. Anak-anak 10-16 tahun: 3 kali sehari 1 tablet.',
                'aturan_pakai' => 'Konsumsi obat setelah makan.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'PKD20501710078',
                'nama' => 'Betadine Antiseptic Solution 10% 30 ml',
                'kategori' => 'Obat Minyak & Oles',
                'jenis_obat' => 'Bebas Terbatas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-24',
                'harga_satuan' => 30400,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Penggunaan obat harus sesuai petunjuk pada kemasan dan anjuran dokter.',
                'aturan_pakai' => 'Baik digunakan untuk mengoleskan maupun kompres.',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'PKD20501800856',
                'nama' => 'Rivanol 100 ml Ika',
                'kategori' => 'Obat Minyak & Oles',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-20',
                'harga_satuan' => 8000,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Gunakan sesuai kebutuhan untuk membersihkan luka.',
                'aturan_pakai' => 'Kompres luka dengan cairan Rivanol 100 ml. Tuangkan cairan pada kasa atau kapas, lalu letakkan di area luka. Selain itu, Rivanol juga dapat digunakan untuk pencucian luka.',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'DTL1624504328A1',
                'nama' => 'Voltaren Gel 20 gr',
                'kategori' => 'Obat Minyak & Oles',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-17',
                'harga_satuan' => 125800,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Oleskan 3-4 x sehari',
                'aturan_pakai' => 'Ambil gel Voltaren secukupnya dengan ujung jari, kemudian oleskan di daerah yang ingin diobati',
                'rute_obat' => 'Topikal',
            ],
            [
                'no_bpom' => 'DBL9104508712A1',
                'nama' => 'Degirol Lozenges Strip 10 Tablet',
                'kategori' => 'THT',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-28',
                'harga_satuan' => 15000,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Dewasa: 1 tablet dihisap, tiap 3 - 4 jam. Maksimal 8 tablet per hari',
                'aturan_pakai' => 'Satu tablet dibiarkan melarut perlahan-lahan di dalam mulut',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DBL7814805548A1',
                'nama' => 'Vital Ear Oil 10 ml',
                'kategori' => 'THT',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-22',
                'harga_satuan' => 17500,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => '2 tetes, 3 kali per hari.',
                'aturan_pakai' => 'Miringkan kepala dengan telinga yang bermasalah menghadap ke atas. Teteskan obat sesuai dosis yang dianjurkan, lalu tarik daun telinga ke belakang atas dan tahan posisi tersebut selama 5 menit agar obat meresap dengan baik.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DBL0333508835A1',
                'nama' => 'Cooling 5 Mouth Spray 15 ml',
                'kategori' => 'THT',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-25',
                'harga_satuan' => 44100,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Cukup disemprotkan 2-3 kali, semprotan dapat diulang tiap 3 jam sampai gejala reda',
                'aturan_pakai' => 'Semprotkan tepat ke arah tenggorokan',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DTL8603804546A1',
                'nama' => 'Cendo Protagenta Strip 5 Minidose 0.6 ml',
                'kategori' => 'Mata',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-17',
                'harga_satuan' => 50500,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => 'Untuk melindungi kornea mata: teteskan 1 - 2 tetes ke atas mata yang sakit sehari 4 - 5 kali Untuk pemasangan lensa kontak: 1 - 2 tetes diteteskan ke bagian dalam lensa kontak',
                'aturan_pakai' => 'Teteskan pada mata yang sakit',
                'rute_obat' => 'Okular',
            ],
            [
                'no_bpom' => 'DBL7603810046A1',
                'nama' => 'Cendo Lyteers Eye Drop 15 ml',
                'kategori' => 'Mata',
                'jenis_obat' => 'Bebas',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-03-19',
                'harga_satuan' => 31700,
                'kategori_obat_keras' => 'Bukan Obat Keras',
                'dosis' => '1 - 2 tetes pada masing-masing mata 3 - 4 kali sehari',
                'aturan_pakai' => 'Diteteskan ke mata yang sakit',
                'rute_obat' => 'Okular',
            ],
            [
                'no_bpom' => 'DKI0063401417B2',
                'nama' => 'Thyrozol 10 mg Tablet',
                'kategori' => 'Hormonal',
                'jenis_obat' => 'Keras',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-17',
                'harga_satuan' => 4200,
                'kategori_obat_keras' => 'D',
                'dosis' => 'Dosis Thyrozol 10 mg untuk hipertiroidisme: Dewasa 25-40 mg/hari (maks 40 mg), anak 0.3-0.5 mg/kg/hari, wanita hamil 2.5-10 mg/hari. Persiapan operasi: yodium 10 hari sebelum. Konsultasikan dosis dengan dokter sesuai kondisi individu.',
                'aturan_pakai' => 'Gunakan obat sesuai anjuran dokter dan baca petunjuk pada kemasan. Konsumsi dengan makanan, telan utuh dengan air putih, dan hindari mengunyah. Minum obat secara teratur, jangan ubah dosis tanpa konsultasi, dan jika lupa, ikuti petunjuk jarak waktu.',
                'rute_obat' => 'Oral',
            ],
            [
                'no_bpom' => 'DKI2163401910A1',
                'nama' => 'Euthyrox 50 mcg Tablet',
                'kategori' => 'Hormonal',
                'jenis_obat' => 'Keras',
                'stok' => 15,
                'tanggal_kadaluwarsa' => '2025-02-08',
                'harga_satuan' => 2500,
                'kategori_obat_keras' => 'A',
                'dosis' => 'Dosis Euthyrox bervariasi: untuk gondok, dewasa 75-200 mcg; hipotiroidisme, dewasa awal 25-50 mcg, pemeliharaan 125-250 mcg; anak 12.5-50 mcg. Konsultasi dokter penting untuk dosis yang sesuai dengan kondisi individu.',
                'aturan_pakai' => 'Ikuti dosis dokter, konsumsi obat 30 menit sebelum sarapan dengan air putih. Jangan hentikan tanpa konsultasi. Konsumsi secara teratur pada jam yang sama. Jika lupa, segera minum jika jarak cukup; abaikan jika dekat dan jangan gandakan dosis.',
                'rute_obat' => 'Oral',
            
        ]
    ]);
    }
}
