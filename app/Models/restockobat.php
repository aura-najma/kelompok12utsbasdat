<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockObat extends Model
{
    use HasFactory;

    protected $table = 'restock_obat';

    protected $primaryKey = 'id_restock'; // Primary key menggunakan id_restock
    public $incrementing = false; // id_restock bukan tipe auto-increment
    protected $keyType = 'string'; // Tipe data primary key adalah string

    protected $fillable = [
        'id_restock',
        'no_bpom',
        'jumlah',
        'tanggal_kadaluwarsa',
    ];

    // Relasi ke tabel 'obats'
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'no_bpom', 'no_bpom');
    }
}
