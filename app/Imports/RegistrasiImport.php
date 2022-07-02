<?php

namespace App\Imports;

use App\Models\Registrasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class RegistrasiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Registrasi([
            //
            'tanggal_meninggal' => $row['tanggal_meninggal'],
            'nama_ahliwaris' => $row['nama_ahliwaris'],
            'alamat_ahliwaris'=> $row['alamat_ahliwaris'],
            'nama_meninggal'=> $row['nama_meninggal'],
            'nik'=> $row['nik'],
            'nama_tpu'=> $row['nama_tpu'],
            'blok_makam' => $row['blok_makam'],
            'retribusi' => $row['retribusi'],
        ]);
    }
}
