<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_telepon';
    public $incrementing = false;
    protected $keyType = 'string';

    // Menambahkan kolom baru yang bisa diisi melalui mass-assignment
    protected $fillable = [
        'no_telepon', 
        'nama', 
        'tanggal_lahir', 
        'alamat', 
        'alergi_obat',
        'jenis_kelamin', // menambahkan jenis kelamin
        'ID_Kecamatan',  // menambahkan ID_Kecamatan
    ];

    // Relasi dengan model Pembelian (sudah ada di model Anda)
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'no_telepon', 'no_telepon');
    }

    // Relasi dengan model Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'ID_Kecamatan', 'ID_Kecamatan');
    }

    // Menambahkan casting untuk properti jika perlu (misalnya, jika ID_Kecamatan adalah string)
    protected $casts = [
        'ID_Kecamatan' => 'string', // Pastikan ID_Kecamatan diperlakukan sebagai string
    ];
}
