<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointMember extends Model
{
    use HasFactory;

    protected $table = 'tblmemberpoint'; // Nama tabel
    public $timestamps = false; // Jika tabel tidak menggunakan timestamp

    protected $fillable = [
        'tanggal',
        'memberid',
        'point_tambah',
        'point_kurang',
        'keterangan',
        'customerid',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerid', 'id');
    }
    
}
