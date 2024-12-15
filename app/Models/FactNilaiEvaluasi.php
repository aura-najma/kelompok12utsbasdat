<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactNilaiEvaluasi extends Model
{
    use HasFactory;

    protected $table = 'fact_nilai_evaluasi';
    public $timestamps = false;

    protected $fillable = [
        'id_tipe_evaluasi',
        'id_waktu',
        'id_apoteker',
        'nilai_evaluasi',
    ];

    // Relasi ke dim_apoteker
    public function apoteker()
    {
        return $this->belongsTo(DimApoteker::class, 'id_apoteker', 'id_apoteker');
    }

    // Relasi ke dim_tipe_evaluasi
    public function tipeEvaluasi()
    {
        return $this->belongsTo(DimTipeEvaluasi::class, 'id_tipe_evaluasi', 'id_tipe_evaluasi');
    }

    // Relasi ke dim_waktu_evaluasi
    public function waktuEvaluasi()
    {
        return $this->belongsTo(DimWaktuEvaluasi::class, 'id_waktu', 'id_waktu');
    }
}
