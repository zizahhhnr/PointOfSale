<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_telp',
        'email'
    ];

    public function pelanggan ()
    {
        return $this->hasMany(Pelanggan::class, 'id_pelanggan');
    }

}
