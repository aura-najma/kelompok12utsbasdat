<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactPenjualanPendapatan extends Model
{
    protected $table = 'fact_penjualan_pendapatan';
    protected $fillable = ['id_transaksi', 'id_jenis_obat', 'id_kategori_obat', 'id_waktu', 'harga_satuan', 'jumlah_obat', 'harga_total'];
    public $timestamps = false;

    public function jenisObat()
    {
        return $this->belongsTo(DimJenisObat::class, 'id_jenis_obat', 'id_jenis_obat');
    }

    public function kategoriObat()
    {
        return $this->belongsTo(DimKategoriObat::class, 'id_kategori_obat', 'id_kategori_obat');
    }

    public function waktuTransaksi()
    {
        return $this->belongsTo(DimWaktuTransaksi::class, 'id_waktu', 'id_waktu');
    }

    public function transaksi()
    {
        return $this->belongsTo(DimTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
