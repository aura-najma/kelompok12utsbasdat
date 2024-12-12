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
        'id_invoice', // Tambahkan kolom id_invoice
        'id_pembelian',
        'no_bpom',
        'nama_obat',
        'jumlah_obat',
        'harga_satuan',
        'harga_total',
    ];

    // Disable auto-incrementing as `id_transaksi` is not an integer
    public $incrementing = false;

    // Set the key type to string
    protected $keyType = 'string';

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

    // Relasi ke invoice (opsional jika ada model invoice)
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id_invoice', 'id_invoice');
    }
}
