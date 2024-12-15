<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimKategoriObat extends Model
{
    protected $table = 'dim_kategori_obat';
    protected $fillable = ['id_kategori_obat', 'kategori'];
    public $timestamps = false;

    public function penjualanPendapatan()
    {
        return $this->hasMany(FactPenjualanPendapatan::class, 'id_kategori_obat', 'id_kategori_obat');
    }

    public function penjualanObatWilayah()
    {
        return $this->hasMany(FactPenjualanObatWilayah::class, 'id_kategori_obat', 'id_kategori_obat');
    }
}
