# Lifespring Drugstore — Pharmacy Information System & Data Warehouse

## Gambaran Proyek

**Lifespring Drugstore** merupakan sistem informasi apotek berbasis web yang mengintegrasikan pengelolaan operasional apotek dengan data warehouse untuk mendukung analisis penjualan, pendapatan, dan kualitas pelayanan. Sistem dikembangkan menggunakan **PHP (Laravel), MySQL, dan Pentaho Data Integration**, dengan pendekatan Model–View–Controller (MVC) untuk aplikasi web serta *star schema* untuk kebutuhan analitik.

Proyek ini dikembangkan oleh Kelompok 12 SD-A1, Program Studi S1 Teknologi Sains Data, Universitas Airlangga, sebagai *team-based project* mata kuliah **Basis Data pada tahun 2024**. Pada Ujian Tengah Semester (UTS), pengembangan berfokus pada sistem operasional apotek menggunakan Laravel dan MySQL, kemudian dilanjutkan pada Ujian Akhir Semester (UAS) dengan penyempurnaan database, pembangunan data warehouse, implementasi ETL melalui Pentaho, dan pengembangan dashboard analitik.

Secara keseluruhan, Lifespring menghubungkan proses pencatatan transaksi dengan pengolahan data untuk evaluasi kinerja apotek. Data yang tersimpan dalam sistem operasional ditransformasikan menjadi struktur dimensional, sehingga dapat digunakan untuk memantau pelayanan, pola pembelian, dan tren pendapatan.

**Teknologi utama:** PHP, Laravel, Eloquent ORM, MySQL, Laravel Blade, Pentaho Data Integration

**[Dokumentasi Portofolio](https://aura-najma.github.io/projects/lifespring-data-warehouse/)**

## Tampilan Aplikasi

Aplikasi menyediakan dashboard utama yang dapat diakses setelah apoteker melakukan autentikasi. Dashboard berfungsi sebagai pusat navigasi untuk pengelolaan pasien, daftar dokter, persediaan obat, proses transaksi, serta fitur operasional lainnya.

![Dashboard Operasional](docs/images/Lifespring%20Drugstore_dashboard.png)

## Fitur Utama

### Pengelolaan Pasien, Obat, dan Persediaan

Aplikasi menyediakan fitur CRUD untuk mengelola informasi pasien dan obat dalam database MySQL. Data pasien mencakup identitas, informasi kontak, keluhan, serta riwayat alergi yang digunakan selama proses pembelian.

Pengelolaan obat mencakup informasi nomor BPOM, kategori, harga, stok, tanggal kedaluwarsa, dosis, dan aturan penggunaan. Apoteker dapat menambahkan obat baru, memperbarui data obat, serta melakukan penambahan stok. Jumlah persediaan juga diperbarui berdasarkan transaksi yang telah diproses.

### Pemeriksaan Obat Keras dan Alur Pembelian

Sistem menerapkan pemeriksaan kategori obat sebelum transaksi dilanjutkan. Jika obat yang dipilih termasuk obat keras, aplikasi mengarahkan apoteker untuk memperoleh konfirmasi dari dokter mitra sebelum pembelian diproses.

Selain itu, sistem menampilkan informasi ketersediaan stok dan peringatan apabila terdapat riwayat alergi pasien yang perlu diperhatikan. Pemeriksaan tersebut membantu apoteker melakukan verifikasi sebelum menyelesaikan transaksi.

![Pemeriksaan Obat Keras](docs/images/Lifespring%20Drugstore_cek%20obat%20keras.png)

### Transaksi dan Invoice

Proses pembelian dimulai dengan pencatatan data pasien, keluhan, serta informasi resep apabila tersedia. Selanjutnya, apoteker memilih obat sesuai kebutuhan dan melakukan pemeriksaan terhadap stok yang tersedia.

Saat transaksi diproses, sistem menyimpan informasi pembelian beserta rincian obat, menghitung total harga, dan memperbarui persediaan. Setelah transaksi berhasil dicatat, aplikasi menghasilkan invoice yang memuat informasi pembelian dan dapat dicetak.

### Evaluasi Pelayanan

Pelanggan dapat memberikan penilaian terhadap pelayanan apotek melalui formulir evaluasi. Setiap evaluasi dihubungkan dengan ID pembelian yang tercatat dalam sistem, sehingga penilaian dapat dikaitkan dengan transaksi terkait.

Data evaluasi mencakup penilaian terhadap apotek, pelayanan apoteker, kualitas obat, rating, dan komentar. Informasi ini selanjutnya digunakan sebagai salah satu sumber data dalam pengembangan data warehouse.

## Arsitektur Backend dan Database

### Implementasi Laravel MVC

Backend Lifespring dikembangkan menggunakan arsitektur **Model–View–Controller (MVC)** dari Laravel, dengan pembagian tanggung jawab antara pengelolaan data, logika aplikasi, dan antarmuka pengguna.

Controller menangani proses autentikasi apoteker, pengelolaan data pasien, pemeriksaan obat keras, penambahan serta pembaruan stok, pemrosesan transaksi, dan pembuatan invoice.

Pada sisi model, **Eloquent ORM** digunakan untuk berinteraksi dengan database MySQL. Relasi antarmodel menghubungkan data pasien dengan pembelian, obat dengan transaksi, serta berbagai entitas lain yang digunakan dalam proses operasional apotek.

### Perancangan Database

Database dirancang melalui **Entity Relationship Diagram (ERD)** dan Physical Data Model (PDM) untuk mendefinisikan struktur tabel dan hubungan antarentitas.

Entitas utamanya meliputi Apoteker, Dokter, Pasien, Obat, Pembelian, Transaksi, dan Evaluasi. Struktur tersebut mendukung pengelolaan data operasional sekaligus menyediakan sumber data bagi proses ETL.

![Database Operasional](docs/images/Lifespring%20Drugstore_Database%20SQL.png)

## ETL dan Data Warehouse

Data warehouse dibangun untuk mengolah data yang berasal dari transaksi dan aktivitas operasional apotek menjadi informasi yang dapat dianalisis berdasarkan waktu, wilayah, produk, dan pelayanan.

Proses **Extract, Transform, Load (ETL)** dilakukan menggunakan Pentaho Data Integration dengan mengambil data dari database operasional MySQL, menerapkan transformasi sesuai kebutuhan analitik, lalu memuat hasilnya ke tabel fakta dan dimensi.

Transformasi yang diterapkan mencakup penggabungan data dari beberapa tabel, penyesuaian tipe data, penghapusan duplikasi, pengodean kategori evaluasi menjadi nilai numerik, serta pembentukan dimensi waktu. Proses tersebut menghasilkan data yang lebih terstruktur untuk digunakan dalam analisis multidimensi.

### 1. Data Warehouse Evaluasi Pelayanan

Skema `fact_nilai_evaluasi` dirancang untuk mengintegrasikan data evaluasi pelanggan, informasi apoteker, dan dimensi waktu.

Melalui skema ini, penilaian pelayanan dapat dianalisis berdasarkan periode tertentu, termasuk perbandingan hasil evaluasi apoteker dari bulan ke bulan atau antar-kuartal.

![Star Schema Evaluasi Pelayanan](docs/images/Lifespring%20Drugstore_fact%20nilai%20evaluasi.png)

### 2. Data Warehouse Penjualan Berdasarkan Wilayah

Skema `fact_penjualan_obat_wilayah` menghubungkan informasi transaksi pembelian dengan kategori obat, lokasi pelanggan, dan dimensi waktu.

Struktur tersebut memungkinkan analisis distribusi penjualan obat menurut wilayah Surabaya, sehingga pola pembelian dapat dibandingkan antarwilayah maupun berdasarkan kategori obat.

![Star Schema Penjualan Wilayah](docs/images/Lifespring%20Drugstore_fact%20penjualan%20obat%20wilayah.png)

### 3. Data Warehouse Pendapatan

Skema `fact_penjualan_pendapatan` digunakan untuk mengintegrasikan informasi transaksi dengan atribut produk yang relevan untuk analisis pendapatan.

Melalui skema ini, data penjualan dapat diringkas berdasarkan periode, kategori, dan jenis obat untuk mengidentifikasi pola pendapatan serta kontribusi masing-masing kelompok produk.

![Star Schema Pendapatan](docs/images/Lifespring%20Drugstore_fact%20penjualan%20pendapatan.png)

## Dashboard Analitik

Hasil pengolahan data warehouse dimanfaatkan untuk membangun dashboard analitik menggunakan Laravel. Dashboard dirancang untuk menyajikan informasi operasional dalam bentuk visualisasi yang memudahkan pemantauan penjualan dan evaluasi pelayanan.

### Dashboard Evaluasi Pelayanan

Dashboard evaluasi menampilkan ringkasan penilaian pelanggan terhadap apotek dan pelayanan apoteker. Visualisasi mencakup evaluasi berdasarkan bulan atau kuartal, rata-rata rating, distribusi penilaian, serta ringkasan komentar pelanggan.

Informasi tersebut digunakan untuk membandingkan kualitas pelayanan antarperiode dan mengidentifikasi aspek pelayanan yang perlu diperhatikan.

![Dashboard Evaluasi](docs/images/Lifespring%20Drugstore_dashboard%20evaluasi.png)

### Dashboard Penjualan dan Pendapatan

Dashboard penjualan mengintegrasikan informasi transaksi, kategori obat, wilayah pembelian, dan pendapatan untuk memberikan gambaran kinerja penjualan apotek.

Analisis yang tersedia mencakup distribusi pembelian obat berdasarkan wilayah Surabaya, jumlah penjualan berdasarkan kategori atau jenis obat, tren penjualan dari waktu ke waktu, serta kontribusi pendapatan menurut kelompok produk.

![Dashboard Penjualan](docs/images/Lifespring%20Drugstore_dashboard%20penjualan.png)

## Teknologi yang Digunakan

| Teknologi | Penggunaan |
|---|---|
| PHP & Laravel | Pengembangan aplikasi web, controller, dan logika bisnis |
| Eloquent ORM | Pengelolaan model, relasi, dan operasi database |
| MySQL | Penyimpanan data operasional dan data warehouse |
| Laravel Blade | Pengembangan antarmuka web dan dashboard |
| Pentaho Data Integration | Ekstraksi, transformasi, dan pemuatan data |
| Star Schema | Pemodelan dimensional data warehouse |
| Git & GitHub | Pengelolaan kode dan kolaborasi pengembangan |

## Menjalankan Aplikasi Secara Lokal

Repository ini berisi aplikasi Laravel yang menggunakan database MySQL. Untuk menjalankannya secara lokal, diperlukan PHP, Composer, MySQL, serta konfigurasi database yang sesuai dengan proyek.

### Langkah Dasar

1. Clone repository menggunakan perintah `git clone https://github.com/aura-najma/kelompok12utsbasdat.git`.
2. Masuk ke direktori `kelompok12utsbasdat`.
3. Jalankan `composer install` untuk memasang dependensi PHP.
4. Salin `.env.example` menjadi `.env`, kemudian sesuaikan konfigurasi koneksi MySQL.
5. Jalankan `php artisan key:generate` untuk membuat application key.
6. Siapkan database dan impor struktur serta data proyek yang diperlukan.
7. Jalankan `php artisan serve` untuk mengaktifkan server pengembangan Laravel.
8. Buka `http://127.0.0.1:8000` melalui browser.

**Catatan:** Aplikasi memerlukan skema dan data MySQL yang sesuai dengan konfigurasi proyek. Langkah instalasi ini merupakan panduan dasar dan belum diverifikasi sebagai proses instalasi penuh dari repository yang baru di-clone. Workflow Pentaho memerlukan konfigurasi koneksi tersendiri.

## Sumber Data

Lifespring Drugstore menggunakan kombinasi data hasil web scraping, data sintetis, dan data referensi untuk menyimulasikan kegiatan operasional apotek.

**Data obat** dikumpulkan melalui web scraping dari situs apotek daring sebagai referensi informasi produk. **Data apoteker** menggunakan identitas anggota kelompok sebagai data simulasi, sedangkan **data dokter** menggunakan identitas dummy untuk mendukung alur pemeriksaan resep dan pembelian obat keras.

Data pasien, pembelian, transaksi, serta evaluasi dibuat secara sintetis menggunakan Laravel Factory dan Faker. Sementara itu, informasi wilayah kecamatan dan kelurahan di Kota Surabaya disusun berdasarkan referensi administratif resmi untuk kebutuhan analisis geografis.

Pengelolaan data menggunakan mekanisme seperti Laravel Seeder, Factory, dan impor CSV sesuai dengan jenis data. Data tersebut kemudian digunakan untuk mendukung pengujian aplikasi, pemrosesan transaksi, pengembangan ETL, dan analisis data warehouse.

## Tim Pengembang

Lifespring Drugstore dikembangkan oleh **Kelompok 12 SD-A1**, yang terdiri dari:

- Dyah Ayu Retnoningsih
- Wanda Desi Rahmawati
- Aura Najma Kustiananda
- Ahmad Zulfikar Al Ghiffari

## Catatan Proyek

Lifespring Drugstore merupakan sistem simulasi yang dikembangkan untuk pembelajaran dan implementasi konsep basis data, pengembangan aplikasi web, serta data warehouse. Sistem dan data yang digunakan tidak merepresentasikan operasional apotek komersial yang sebenarnya.
