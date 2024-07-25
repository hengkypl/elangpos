<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'tblcustomer'; // Nama tabel
    protected $primaryKey = 'id'; // Nama kolom primary key
    public $incrementing = false; // Menunjukkan bahwa primary key bukan auto-incrementing
    protected $keyType = 'string'; // Menunjukkan bahwa primary key adalah string
    public $timestamps = false; // Jika tabel tidak menggunakan timestamp

    protected $fillable = [
        'nama', // Kolom yang bisa diisi secara massal
        'alamat',
        'telepon',
        'kota',
        'hp',
        'kontak',
        'memberid',
    ];

    public function pointMembers()
    {
        return $this->hasMany(PointMember::class, 'customerid', 'id');
    }

}
