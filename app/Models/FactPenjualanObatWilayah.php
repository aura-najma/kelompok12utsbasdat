<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactPenjualanObatWilayah extends Model
{
    protected $table = 'fact_penjualan_obat_wilayah';
    protected $fillable = ['id_waktu', 'id_wilayah', 'id_kategori_obat', 'jumlah_obat'];
    public $timestamps = false;

    public function waktuTransaksi()
    {
        return $this->belongsTo(DimWaktuTransaksi::class, 'id_waktu', 'id_waktu');
    }

    public function wilayah()
    {
        return $this->belongsTo(DimWilayah::class, 'id_wilayah', 'id_wilayah');
    }

    public function kategoriObat()
    {
        return $this->belongsTo(DimKategoriObat::class, 'id_kategori_obat', 'id_kategori_obat');
    }
}
