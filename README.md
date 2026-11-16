# Lifespring Drugstore — Pharmacy Information System & Data Warehouse

## Gambaran Proyek

**Lifespring Drugstore** merupakan sistem informasi apotek berbasis web yang dikembangkan menggunakan **PHP (Laravel) dan MySQL**, lalu diintegrasikan dengan **data warehouse** menggunakan **Pentaho Data Integration**. Sistem ini dirancang untuk mensimulasikan pengelolaan operasional apotek, mulai dari pencatatan pasien, pengelolaan obat dan persediaan, pemeriksaan resep, pemrosesan transaksi, hingga evaluasi pelayanan dan analisis penjualan.

Pengembangan sistem mencakup:
- aplikasi operasional berbasis Laravel,
- perancangan database relasional,
- proses **Extract, Transform, Load (ETL)**,
- serta dashboard analitik untuk mendukung evaluasi pelayanan, penjualan, dan pendapatan.

Projek ini dikembangkan oleh Ahmad Zulfikar Al Ghiffari, Aura Najma Kustiananda, Dyah Ayu Retnoningsih, dan Wanda Desi Rahmawati.

## Tampilan Dashboard Operasional

Berikut adalah tampilan dashboard utama pada aplikasi operasional Lifespring Drugstore.

![Dashboard Operasional](docs/images/Lifespring%20Drugstore_dashboard.png)

---

## Fitur Utama

Sistem Lifespring Drugstore memiliki beberapa fitur utama sebagai berikut:

- **Autentikasi Apoteker**  
  Login menggunakan NIP dan password, disertai pengelolaan sesi pengguna.

- **Manajemen Pasien**  
  Pencatatan dan pembaruan data pasien, termasuk identitas, keluhan, riwayat pembelian, dan informasi alergi obat.

- **Manajemen Obat**  
  Pengelolaan data obat, kategori, harga, dosis, tanggal kedaluwarsa, dan stok.

- **Manajemen Persediaan**  
  Penambahan obat baru, restock, serta pembaruan stok berdasarkan transaksi penjualan.

- **Pemeriksaan Obat Keras**  
  Identifikasi kategori obat dan dukungan alur konfirmasi dokter sebelum pembelian obat keras dilanjutkan.

- **Transaksi Penjualan**  
  Pencatatan pembelian, perhitungan harga, pengurangan stok, dan pembuatan invoice.

- **Evaluasi Pelayanan**  
  Pencatatan rating dan komentar pelanggan berdasarkan ID pembelian.

- **Dashboard Analitik**  
  Visualisasi evaluasi pelayanan, penjualan, dan pendapatan berdasarkan data warehouse.

## Pemeriksaan Obat Keras

Sistem melakukan pengecekan apakah obat yang dipilih termasuk kategori obat keras. Jika ya, maka pembelian perlu melalui alur konfirmasi dokter terlebih dahulu.

![Pemeriksaan Obat Keras](docs/images/Lifespring%20Drugstore_cek%20obat%20keras.png)

---

## Arsitektur Backend dan Database

Aplikasi dikembangkan menggunakan arsitektur **Model–View–Controller (MVC)** pada Laravel.

Backend menangani:
- autentikasi pengguna,
- pengelolaan data pasien dan obat,
- pemeriksaan stok,
- pemrosesan transaksi,
- serta pembuatan invoice.

**Eloquent ORM** digunakan untuk menghubungkan model aplikasi dengan database MySQL dan mempermudah pengelolaan relasi antartabel serta operasi CRUD.

Database operasional dirancang menggunakan **Entity Relationship Diagram (ERD)** dan **Physical Data Model (PDM)** untuk mendefinisikan entitas, atribut, primary key, foreign key, dan relasi data.

Entitas utama dalam sistem meliputi:
- Apoteker
- Dokter
- Pasien
- Obat
- Pembelian
- Transaksi
- Evaluasi

## Struktur Database Operasional

Berikut adalah struktur database operasional yang digunakan dalam sistem.

![Struktur Database Operasional](docs/images/Lifespring%20Drugstore_Database%20SQL.png)

---

## Alur Transaksi Pembelian Obat

Alur transaksi pembelian obat pada sistem secara umum adalah sebagai berikut:

1. Apoteker login ke dalam aplikasi.
2. Apoteker memasukkan atau memperbarui data pasien.
3. Sistem memeriksa data obat yang dipilih, termasuk kategori obat keras dan ketersediaan stok.
4. Jika obat termasuk obat keras, sistem mendukung proses konfirmasi dokter.
5. Apoteker memproses pembelian dan sistem menghitung total harga.
6. Data transaksi disimpan ke database.
7. Stok obat diperbarui sesuai jumlah pembelian.
8. Sistem menghasilkan invoice.
9. Pelanggan dapat memberikan evaluasi pelayanan berdasarkan ID pembelian.

---

## ETL dan Data Warehouse

Untuk mendukung kebutuhan analitik, data operasional diolah menjadi **data warehouse** menggunakan **Pentaho Data Integration**.

Proses **ETL (Extract, Transform, Load)** dilakukan melalui tahapan berikut:

### 1. Extract
Mengambil data dari tabel-tabel operasional MySQL, termasuk data:
- pasien,
- obat,
- apoteker,
- transaksi,
- pembelian,
- dan evaluasi.

### 2. Transform
Melakukan proses seperti:
- penggabungan data antartabel,
- konversi tipe data,
- penghapusan duplikasi,
- pengodean nilai kategoris,
- pembentukan atribut dimensi,
- serta pembentukan struktur untuk kebutuhan analisis.

### 3. Load
Memuat data hasil transformasi ke dalam tabel fakta dan tabel dimensi pada data warehouse.

Contoh transformasi yang dilakukan:
- mengubah kategori evaluasi menjadi nilai numerik,
- membentuk dimensi waktu berdasarkan bulan, kuartal, dan tahun,
- menghubungkan transaksi dengan data obat dan wilayah,
- serta menyiapkan data penjualan dan pendapatan untuk analisis.

---

## Skema Data Warehouse

Data warehouse pada Lifespring Drugstore menggunakan tiga *star schema* utama.

### 1. Evaluasi Pelayanan Apoteker

Skema `fact_nilai_evaluasi` digunakan untuk menganalisis evaluasi pelayanan berdasarkan apoteker dan waktu.

![Fact Nilai Evaluasi](docs/images/Lifespring%20Drugstore_fact%20nilai%20evaluasi.png)

### 2. Penjualan Obat Berdasarkan Wilayah

Skema `fact_penjualan_obat_wilayah` digunakan untuk menganalisis distribusi penjualan obat berdasarkan wilayah pelanggan.

![Fact Penjualan Obat Wilayah](docs/images/Lifespring%20Drugstore_fact%20penjualan%20obat%20wilayah.png)

### 3. Pendapatan Penjualan

Skema `fact_penjualan_pendapatan` digunakan untuk menganalisis pendapatan berdasarkan transaksi, kategori, dan jenis obat.

![Fact Penjualan Pendapatan](docs/images/Lifespring%20Drugstore_fact%20penjualan%20pendapatan.png)

---

## Dashboard Analitik

Data warehouse yang telah dibangun digunakan sebagai dasar untuk menghasilkan dashboard analitik.

Dashboard mendukung analisis seperti:
- evaluasi kinerja apoteker,
- distribusi penjualan berdasarkan wilayah,
- jumlah penjualan obat berdasarkan kategori,
- tren pendapatan,
- serta ringkasan evaluasi pelanggan.

### Dashboard Evaluasi

Berikut adalah contoh tampilan dashboard evaluasi pelayanan.

![Dashboard Evaluasi](docs/images/Lifespring%20Drugstore_dashboard%20evaluasi.png)

### Dashboard Penjualan

Berikut adalah contoh tampilan dashboard penjualan.

![Dashboard Penjualan](docs/images/Lifespring%20Drugstore_dashboard%20penjualan.png)

---

## Teknologi yang Digunakan

| Teknologi | Penggunaan |
|---|---|
| PHP & Laravel | Pengembangan aplikasi web dan logika backend |
| Eloquent ORM | Pengelolaan model, relasi, dan operasi database |
| MySQL | Database operasional dan data warehouse |
| Laravel Blade | Pengembangan tampilan aplikasi |
| Pentaho Data Integration | Proses ETL dan integrasi data |
| Star Schema | Pemodelan dimensional data warehouse |
| Git & GitHub | Version control dan kolaborasi pengembangan |

---

## Sumber Data dan Pengembangan

Data dalam Lifespring Drugstore diperoleh melalui kombinasi **web scraping, data simulasi, dan informasi referensi** untuk merepresentasikan operasional apotek.

- **Data obat:** Dikumpulkan melalui web scraping dari salah satu situs apotek daring, lalu digunakan sebagai referensi informasi produk obat dalam sistem.
- **Data apoteker:** Menggunakan identitas anggota kelompok sebagai data simulasi tenaga apoteker.
- **Data dokter:** Menggunakan data dummy untuk merepresentasikan dokter mitra dalam alur pemeriksaan resep obat keras.
- **Data pasien, pembelian, transaksi, dan evaluasi:** Dihasilkan secara sintetis menggunakan Laravel Factory dan Faker untuk mensimulasikan aktivitas operasional apotek.
- **Data wilayah:** Menggunakan informasi administratif resmi mengenai kecamatan dan kelurahan di Kota Surabaya sebagai referensi geografis pelanggan.

Data dimasukkan ke database MySQL melalui mekanisme seperti **Seeder, Factory, Faker, dan file CSV** sesuai kebutuhan masing-masing komponen data.

Selanjutnya, data operasional digunakan untuk:
- pengujian fitur aplikasi,
- pemrosesan transaksi,
- pengembangan ETL,
- dan analisis melalui data warehouse.

---

## Catatan

Lifespring Drugstore merupakan proyek pengembangan sistem berbasis simulasi. Sistem ini dibuat untuk merepresentasikan proses bisnis apotek dan kebutuhan analitik berbasis data warehouse, sehingga data yang digunakan bukan data operasional apotek komersial secara nyata.
