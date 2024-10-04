<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $primaryKey = 'no_bpom'; // Primary key diubah menjadi `no_bpom`
    public $incrementing = false; // Karena `no_bpom` bukan tipe auto-increment
    protected $keyType = 'string'; // Tipe data primary key adalah string

    protected $fillable = [
        'no_bpom', 
        'nama', 
        'kategori', 
        'jenis_obat', 
        'stok', 
        'tanggal_produksi', 
        'tanggal_kadaluwarsa', 
        'harga_satuan', 
        'kategori_obat_keras', 
        'dosis', 
        'aturan_pakai', 
        'rute_obat'
    ];
}
