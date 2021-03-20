<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $guarded = [];
    
    public function pasok()
    {
        return $this->hasMany(Pasok::class);
    }
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
