<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasok extends Model
{
    use HasFactory;
    protected $table = 'pasok';
    protected $guarded = [];
    
    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
    public function pasokBarang()
    {
        return $this->hasMany(PasokBarang::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
