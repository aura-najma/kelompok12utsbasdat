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
        'nama_obat',
        'jumlah_obat',
        'harga_satuan',
        'harga_total',
    ];


    // Disable auto-incrementing as `id_transaksi` is not an integer
    public $incrementing = false;

    // Set the key type to string
    protected $keyType = 'string';
}
