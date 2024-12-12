<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoteker extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'apoteker';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'NIP',
        'password',
        'nama',
        'no_hp',
        'email',
        'alamat',
        'jam_kerja',
    ];

    // Jika Anda ingin mengenkripsi password secara otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->password = bcrypt($model->password);
        });
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'nip', 'NIP');
    }
    
}
