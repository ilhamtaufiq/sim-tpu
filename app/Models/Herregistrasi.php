<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herregistrasi extends Model
{
    use HasFactory;
    protected $table = 'db_herregistrasi';
    protected $fillable = [
        'registrasi_id',
        'nominal'
    ];

    /**
     * Get the user that owns the Herregistrasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registrasi()
    {
        return $this->belongsTo(Registrasi::class, 'registrasi_id', 'id');
    }
}

