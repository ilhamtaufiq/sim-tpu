<?php

namespace App\Exports;

use App\Models\Registrasi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrasiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = Registrasi::with('ahliwaris')->get();
        return view('exports.registrasi', compact('data'));
    }
}
