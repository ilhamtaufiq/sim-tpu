<?php

namespace App\Http\Controllers;

use App\Models\Inv;
use App\Models\Registrasi;
use Illuminate\Http\Request;

class InvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Registrasi::get();        
        return view('pages.pembayaran.registrasi', compact('data'));
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inv  $inv
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $where = array('id' => $request->id);
        $data  = Registrasi::where($where)->first();
      
        return Response()->json($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inv  $inv
     * @return \Illuminate\Http\Response
     */
    public function edit(Inv $inv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inv  $inv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inv $inv)
    {
        //
    }

    public function status()
    {
        return view('pages.pembayaran.status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inv  $inv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inv $inv)
    {
        //
    }
}
