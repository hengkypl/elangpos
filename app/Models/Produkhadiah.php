<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkhadiah extends Model
{
    use HasFactory;

    protected $fillable = [
        'namabarang',
        'point',
        'keterangan',
        'foto',
    ];
    
}
