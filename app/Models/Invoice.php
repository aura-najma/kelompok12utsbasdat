<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'id_invoice';

    protected $fillable = [
        'id_pembelian',
        'id_transaksi',
        'nama_obat',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'dosis',
        'aturan_pakai',
    ];
}
