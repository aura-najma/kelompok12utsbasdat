<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimWaktuTransaksi extends Model
{
    protected $table = 'dim_waktu_transaksi';
    protected $fillable = ['id_waktu', 'tanggal_transaksi', 'tahun', 'bulan', 'hari', 'kuartal'];
    public $timestamps = false;

    public function penjualanPendapatan()
    {
        return $this->hasMany(FactPenjualanPendapatan::class, 'id_waktu', 'id_waktu');
    }

    public function penjualanObatWilayah()
    {
        return $this->hasMany(FactPenjualanObatWilayah::class, 'id_waktu', 'id_waktu');
    }
}
