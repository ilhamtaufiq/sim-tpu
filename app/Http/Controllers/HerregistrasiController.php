<?php

namespace App\Http\Controllers;

use App\Models\Herregistrasi;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;



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
        $bayar = $data->nominal;
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $bayar,
            ),
            'customer_details' => array(
                'first_name' => $data->registrasi->ahliwaris->nama,
                'last_name' => '',
                'email' => 'ilhamtaufiq@gmail.com',
                'phone' => '6285217795994',
            ),
        );
        $snap_token = \Midtrans\Snap::getSnapToken($params);
        return view('pages.ahliwaris.retribusi',compact('data','bayar','snap_token'));
    }
    public function payment_post(Request $request){
        $json = json_decode($request->get('json'));
        $order = new Order();
        $order->status = $json->transaction_status;
        $order->uname = 'ilham';
        $order->email = 'ilhamtaufiq@gmail.com';
        $order->number = '085217795994';
        $order->transaction_id = $json->transaction_id;
        $order->order_id = $json->order_id;
        $order->gross_amount = $json->gross_amount;
        $order->payment_type = $json->payment_type;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        return $order->save() ? redirect(url('/'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');     
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
