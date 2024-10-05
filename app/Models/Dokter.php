<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter'; // Nama tabel yang sesuai dengan database
    protected $primaryKey = 'nomor_str'; // Primary key
    public $incrementing = false; // Karena primary key bukan integer, maka auto increment dinonaktifkan
    protected $keyType = 'string'; // Primary key berupa string
    protected $fillable = ['nama_dokter', 'nomor_str', 'spesialisasi', 'alamat', 'hubungi']; // Kolom yang dapat diisi
}
