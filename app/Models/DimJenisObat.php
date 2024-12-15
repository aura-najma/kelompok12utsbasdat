<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimJenisObat extends Model
{
    protected $table = 'dim_jenis_obat';
    protected $fillable = ['id_jenis_obat', 'jenis_obat'];
    public $timestamps = false;

    public function penjualanPendapatan()
    {
        return $this->hasMany(FactPenjualanPendapatan::class, 'id_jenis_obat', 'id_jenis_obat');
    }
}
