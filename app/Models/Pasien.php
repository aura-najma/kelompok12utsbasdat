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


    protected $fillable = ['no_telepon', 'nama', 'tanggal_lahir', 'alamat', 'alergi_obat'];


    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'no_telepon', 'no_telepon');
    }

}

