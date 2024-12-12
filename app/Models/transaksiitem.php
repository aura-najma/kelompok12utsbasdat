<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'transaksi_items';

    // Primary key tabel
    protected $primaryKey = 'id';

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'id_transaksi',
        'id_obat',
        'jumlah_obat',
        'harga_satuan',
        'harga_total',
    ];

    // Relasi ke tabel transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi ke tabel obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }
}
