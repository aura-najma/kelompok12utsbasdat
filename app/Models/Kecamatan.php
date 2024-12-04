<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai konvensi)
    protected $table = 'kecamatans';

    // Relasi: satu kecamatan memiliki banyak kelurahan
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class, 'ID_Kecamatan', 'ID_Kecamatan');
    }
}
