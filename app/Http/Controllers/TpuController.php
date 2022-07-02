<?php

namespace App\Http\Controllers;

use App\Models\Tpu;
use Illuminate\Http\Request;
use DataTables;


class TpuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tpu = Tpu::select(
                'id',
                'nama_tpu',
                'alamat_tpu',
                'luas_tpu',
                'kode_tpu',
            );
            return Datatables::of($tpu)
            ->addIndexColumn()
            ->make(true);
        }
        return view('pages.tpu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tpu  $tpu
     * @return \Illuminate\Http\Response
     */
    public function show(Tpu $tpu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tpu  $tpu
     * @return \Illuminate\Http\Response
     */
    public function edit(Tpu $tpu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tpu  $tpu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tpu $tpu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tpu  $tpu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tpu $tpu)
    {
        //
    }
}
