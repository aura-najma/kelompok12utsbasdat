<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'evaluasi'; // Nama tabel yang benar
    protected $primaryKey = 'id_evaluasi';
    public $incrementing = false; // Non-auto-increment
    protected $keyType = 'string';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_evaluasi', 'id_invoice', 'tanggal_transaksi', 'evaluasi_apotek', 'evaluasi_pelayanan', 'evaluasi_obat', 'rating_apotek', 'komentar'
    ];
}




