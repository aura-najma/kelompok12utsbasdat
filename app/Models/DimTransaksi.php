<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimTransaksi extends Model
{
    protected $table = 'dim_transaksi';
    protected $fillable = [
        'id_transaksi', 
        'id_pembelian', 
        'no_bpom', 
        'nama_obat', 
        'jenis_obat', 
        'kategori', 
        'harga_satuan', 
        'jumlah_obat', 
        'confirmed_at'
    ];
    public $timestamps = false;

    public function penjualanPendapatan()
    {
        return $this->hasMany(FactPenjualanPendapatan::class, 'id_transaksi', 'id_transaksi');
    }
}
