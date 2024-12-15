<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimWaktuEvaluasi extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'dim_waktu_evaluasi';

    // Primary key tabel
    protected $primaryKey = 'id_waktu';

    // Jika tidak menggunakan timestamp bawaan Laravel
    public $timestamps = false;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'tanggal_transaksi',
        'tahun',
        'bulan',
        'hari',
        'kuartal',
    ];
    // Cast `tanggal_transaksi` ke datetime
    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];
    // Relasi ke fact_nilai_evaluasi
    public function evaluasi()
    {
        return $this->hasMany(FactNilaiEvaluasi::class, 'id_waktu', 'id_waktu');
    }
}
