<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

// Transaksi.php (Model)
    protected $fillable = [
        'id_transaksi',
        'id_pembelian',
        'no_bpom',
        'nama_obat',
        'jumlah_obat',
        'harga_satuan',
        'harga_total',
        'nip',
    ];


    // Disable auto-incrementing as `id_transaksi` is not an integer
    public $incrementing = false;

    // Set the key type to string
    protected $keyType = 'string';

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id_pembelian');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'no_bpom', 'no_bpom');
    }

        // Relasi ke apoteker
    public function apoteker()
    {
        return $this->belongsTo(Apoteker::class, 'nip', 'NIP');
    }
}
