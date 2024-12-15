<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimTipeEvaluasi extends Model
{
    use HasFactory;

    protected $table = 'dim_tipe_evaluasi';
    protected $primaryKey = 'id_tipe_evaluasi';
    public $timestamps = false;

    protected $fillable = [
        'nama_tipe_evaluasi',
    ];

    public function evaluasi()
    {
        return $this->hasMany(FactNilaiEvaluasi::class, 'id_tipe_evaluasi', 'id_tipe_evaluasi');
    }
}
