<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasokBarang extends Model
{
    use HasFactory;
    protected $table = 'pasok_barang';
    protected $guarded = [];
    
    public function pasok()
    {
        return $this->belongsTo(Pasok::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
