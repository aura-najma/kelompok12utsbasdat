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
        'harga_satuan',
        'kategori_obat_keras',
        'dosis',
        'aturan_pakai',
        'rute_obat',
    ];

    // Relasi ke tabel 'transaksis'
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'no_bpom', 'no_bpom');
    }

    // Relasi ke tabel 'restock_obat' (untuk mendukung restocking dan tanggal kadaluwarsa)
    public function restockObat()
    {
        return $this->hasMany(RestockObat::class, 'no_bpom', 'no_bpom');
    }

    // Menambahkan method untuk menghitung stok total berdasarkan restock
    public function getTotalStokAttribute()
    {
        // Ambil total stok dari restock_obat dan obat
        return $this->stok + $this->restockObat->sum('jumlah');
    }
}
