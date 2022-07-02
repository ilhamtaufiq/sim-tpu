<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makam extends Model
{
    use HasFactory;
    protected $table = 'db_makam';
    protected $fillable = [
        'registrasi_id',
        'kode_makam',
        'foto',
        'path',

    ];
}
