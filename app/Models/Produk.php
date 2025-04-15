<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id_produk';
    protected $fillable = [ 
        'no_invoice',
        'nama_produk',
        'id_kategori',
        'id_supplier',
        'harga',
        'stok'
    ];

    public function detail()
    {
        return $this->hasMany(Detail::class, 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public static function generateInvoiceNumber()
    {
    $lastTransaction = self::latest()->first();
    $nextId = $lastTransaction ? $lastTransaction->id + 1 : 1;
    
    return 'INV-' . date('Ymd') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
    }
    
}
