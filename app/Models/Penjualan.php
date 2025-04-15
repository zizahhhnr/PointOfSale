<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table ='penjualans';
    protected $primaryKey ='id_penjualan';
    protected $fillable = [
        'id_pelanggan',
        'nama_pembeli',
        'tgl_penjualan',
        'id_detail',
        'total_harga',
        'uang_bayar',
        'kembali',
    ];


    public function details()
    {
        return $this->hasMany(Detail::class, 'id_penjualan');
    }

    public function pelanggan ()
    { 
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

}
