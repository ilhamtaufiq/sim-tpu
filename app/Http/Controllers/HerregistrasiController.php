<?php

namespace App\Http\Controllers;

use App\Models\Herregistrasi;
use App\Models\Order;
use Illuminate\Http\Request;




class HerregistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Herregistrasi::with('registrasi.ahliwaris')->get();

        $id = $request->id;
        if ($request->ajax()) {
            $data = Herregistrasi::with('registrasi.ahliwaris')->where('id', $id)->first();
            return response()->json($data, 200);
        }
            

        return view('pages.pembayaran.herregistrasi', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        $data = Herregistrasi::with('registrasi.ahliwaris')->where('id', $request->id)->first();
        return view('pages.ahliwaris.retribusi',compact('data','bayar','snap_token'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regId = $request->id;
        $rules = [
            'registrasi_id' => 'required',
            'nominal' => 'required',
        ];
        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'unique'    => ':attribute sudah digunakan',

        ];
        $attributeNames = array(
            'registrasi_id' => 'Nama Ahli Waris',
            'nominal' => 'Nominal',  
        );
    
        $valid = $this->validate($request, $rules, $customMessages, $attributeNames);

        $herregistrasi = Herregistrasi::updateOrCreate(
            [
                'id' => $regId,
            ],
            [
            'registrasi_id' => $request->registrasi_id,
            'nominal' => $request->nominal,
        ]);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Herregistrasi  $herregistrasi
     * @return \Illuminate\Http\Response
     */
    public function show(Herregistrasi $herregistrasi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Herregistrasi  $herregistrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Herregistrasi $herregistrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Herregistrasi  $herregistrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Herregistrasi $herregistrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Herregistrasi  $herregistrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Herregistrasi $herregistrasi)
    {
        //
    }
}
