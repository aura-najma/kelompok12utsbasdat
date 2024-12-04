<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai konvensi)
    protected $table = 'kelurahans';

    // Relasi: setiap kelurahan milik satu kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'ID_Kecamatan', 'ID_Kecamatan');
    }
}
