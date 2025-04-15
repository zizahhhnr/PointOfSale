<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'nama_supplier',
        'no_telp',
        'email',
        'kontak_person'
    ];

    public function supplier()
    {
        return $this->hasMany(Supplier::class, 'id_supplier');
    }


}
