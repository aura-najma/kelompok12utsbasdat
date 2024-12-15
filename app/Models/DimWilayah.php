<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimWilayah extends Model
{
    protected $table = 'dim_wilayah';
    protected $fillable = ['Wilayah', 'id_wilayah', 'id_kecamatan', 'Kecamatan', 'id_kelurahan', 'Kelurahan'];
    public $timestamps = false;

    public function penjualanObatWilayah()
    {
        return $this->hasMany(FactPenjualanObatWilayah::class, 'id_wilayah', 'id_wilayah');
    }
}
