<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
    protected $table = 'evaluasi'; 
    protected $primaryKey = 'id_evaluasi';
    public $incrementing = false; 
    protected $keyType = 'string';

    // Tambahkan kolom custom timestamps ke $fillable
    protected $fillable = [
        'id_evaluasi', 'id_invoice', 'tanggal_transaksi', 'evaluasi_apotek', 'evaluasi_pelayanan', 
        'evaluasi_obat', 'rating_apotek', 'komentar', 'evaluasi_dibuat', 'evaluasi_diperbarui',
    ];

    // Disable default timestamps
    public $timestamps = false;

    // Define custom timestamps manually
    const CREATED_AT = 'evaluasi_dibuat';
    const UPDATED_AT = 'evaluasi_diperbarui';
}
