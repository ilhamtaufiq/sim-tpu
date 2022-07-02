<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv extends Model
{
    use HasFactory;
    protected $table = 'db_inv';
    protected $fillable = [
        'total_pembayaran',
        'kode_registrasi'
    ];

    /**
     * Get the user associated with the Inv
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function registrasi()
    {
        return $this->hasOne(Registrasi::class, 'kode_registrasi', 'kode_registrasi');
    }
}
