<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter'; // Nama tabel

    // Jika ada kolom yang tidak ingin diisi massal, seperti 'id', tambahkan di sini
    protected $guarded = ['id'];

    // Jika tidak ada timestamps (created_at, updated_at), tambahkan:
    public $timestamps = false;
}
