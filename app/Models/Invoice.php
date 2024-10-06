<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'invoices';

    // Primary key
    protected $primaryKey = 'id_invoice';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_invoice',
        'id_pembelian',
        'id_transaksi',
        'total_harga',
        'created_at',
        'updated_at'
    ];

    // Relasi dengan model lainnya
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id_pembelian');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}

