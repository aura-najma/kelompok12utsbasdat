<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_transaksi',
        'id_invoice',
        'id_pembelian',
        'no_bpom',
        'nama_obat',
        'jumlah_obat',
        'harga_satuan',
        'harga_total',
        'created_at',
        'updated_at',
        'confirmed_at',
    ];

    // Non-auto-incrementing primary key
    public $incrementing = false;

    // Set key type to string
    protected $keyType = 'string';

    // Table name (if different from class name)
    protected $table = 'transaksis';

    // Relasi ke tabel pembelian
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id_pembelian');
    }

    // Relasi ke tabel obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'no_bpom', 'no_bpom');
    }

    // Relasi ke tabel apoteker
    public function apoteker()
    {
        return $this->belongsTo(Apoteker::class, 'nip', 'NIP');
    }

    // Relasi ke tabel evaluasi
    public function evaluasi()
    {
        return $this->hasOne(Evaluasi::class, 'id_invoice', 'id_invoice');
    }

    // Relasi ke invoice jika memiliki model invoice

}
