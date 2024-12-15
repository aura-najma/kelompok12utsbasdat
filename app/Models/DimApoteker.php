<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimApoteker extends Model
{
    use HasFactory;

    protected $table = 'dim_apoteker';
    protected $primaryKey = 'id_apoteker';
    public $timestamps = false;

    protected $fillable = [
        'nama_apoteker',
        'jam_kerja',
    ];

    public function evaluasi()
    {
        return $this->hasMany(FactNilaiEvaluasi::class, 'id_apoteker', 'id_apoteker');
    }
}
