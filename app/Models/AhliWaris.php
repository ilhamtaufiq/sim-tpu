<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliWaris extends Model
{
    use HasFactory;
    protected $table = 'db_ahliwaris';
    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'nomor_telepon'
    ];

    /**
     * Get all of the comments for the AhliWaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrasi()
    {
        return $this->hasMany(Registrasi::class, 'id_ahliwaris', 'id');
    }
}
