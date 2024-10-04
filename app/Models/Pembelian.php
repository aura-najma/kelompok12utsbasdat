<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'new_id',
        'no_telepon',
        'keluhan',
        'resep',
    ];
    // Relasi ke model Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_telepon', 'no_telepon');
    }
}
