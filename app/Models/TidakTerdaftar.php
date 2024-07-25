<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TidakTerdaftar extends Model
{
    use HasFactory;

    protected $table = 'tidakterdaftar';

    protected $fillable = ['kassa', 'operator', 'kodebarang'];
}
