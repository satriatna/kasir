<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    use HasFactory;
    protected $table = 'penjualan_barang';
    protected $guarded = [];
    
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
