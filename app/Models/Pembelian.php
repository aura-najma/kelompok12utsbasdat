<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pembelian',
        'no_telepon',
        'keluhan',
        'resep',
        'custom_created_at',
        'custom_updated_at',
        'nip', // Tambahkan nip sebagai bagian dari kolom yang dapat diisi
    ];

    // Relasi ke model Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_telepon', 'no_telepon');
    }

    // Relasi ke model Apoteker (Many-to-One)
    // Model Apoteker
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'nip', 'NIP');
    }

}
