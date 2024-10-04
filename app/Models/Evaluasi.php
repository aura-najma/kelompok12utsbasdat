<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pembeli',
        'tanggal_transaksi',
        'evaluasi_apotek',
        'evaluasi_pelayanan',
        'evaluasi_obat',
        'rating_apotek',
        'komentar',
    ];
}
