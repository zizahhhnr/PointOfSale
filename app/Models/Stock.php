<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $primaryKey = 'id_stock';
    protected $fillable = [
        'satuan',
        'deskripsi'
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class, 'id_stock');

    }
}


