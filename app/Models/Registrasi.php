<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;
    protected $table = 'db_registrasi';
    protected $fillable = [
        'kode_registrasi',
        'tanggal_meninggal',
        'id_ahliwaris',
        'nama_meninggal',
        'tempat_meninggal',
        'nik',
        'agama',
        'id_makam',
        'nama_tpu',
        'blok_makam',
        'ambulance',
        'retribusi',
    ];

    public function scopeSeason($query,$year)
    {
        return $query->whereYear('tanggal_meninggal', '=', $year);
    }

    public function scopeMonth($query,$month)
    {
        return $query->whereMonth('tanggal_meninggal', '=', $month);
    }

    /**
     * Get the user associated with the Registrasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ahliwaris()
    {
        return $this->hasOne(AhliWaris::class, 'id', 'id_ahliwaris');
    }
}