<?php

namespace App\Http\Controllers;

use App\Models\Registrasi;
use App\Models\Inv;
use App\Models\Order;

use App\Models\Tpu;
use App\Models\Herregistrasi;
use Midtrans\Snap;
use Midtrans\Config;

use Illuminate\Http\Request;
use App\Imports\RegistrasiImport;
use App\Exports\RegistrasiExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Carbon\Carbon;
use DB;

class RegistrasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tpu = Tpu::get();
        $model = Registrasi::with('ahliwaris');
        if ($request->ajax()) {
            $registrasi = Registrasi::with('ahliwaris')->select(
                'id',
                'tanggal_meninggal',
                'nama_meninggal',
                'tempat_meninggal',
                'nik',
                'nama_tpu',
                'blok_makam',
                'ambulance',
                'retribusi',
            );
            return Datatables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('nama_ahliwaris', function (Registrasi $registrasi) {
                    return $registrasi->ahliwaris->nama;
                })
                ->addColumn('alamat_ahliwaris', function (Registrasi $registrasi) {
                    return $registrasi->ahliwaris->alamat;
                })
                
                ->addColumn('action', function(Registrasi $registrasi){
                    $actionBtn = '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opsi <i class="mdi mdi-chevron-down"></i></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="update('.$registrasi->id.')">Ubah</a>
                        <a class="dropdown-item btn-hapus" href="javascript:void(0)" onclick="hapus('.$registrasi->id.')">Hapus</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/registrasi/detail?id='.$registrasi->id.'">Detail</a>
                    </div>
                    </div>';
                    return $actionBtn;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.registrasi.index', compact('tpu'));
    }

    public function import(Request $request) 
    {
        Excel::import(new RegistrasiImport, $request->file('file')->store('temp'));        
        return back()->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new RegistrasiExport, 'data-registrasi.xlsx');
    }


    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // inisiasi
        $regId = $request->id;
        $kode_tpu = $request->nama_tpu;
        $blok_tpu = $request->blok_makam;
        $nominal = 40000;
        $string = ['Rp',',00','.'];
        if ($regId == null) {
            $kodeReg = $kode_tpu.'-'.$blok_tpu.rand(00000, 99999);
        } else {
            $kodeReg = $request->kode_registrasi;
        }
        
        $rules = [
            'id_ahliwaris' => 'required',
            'nama_meninggal' => 'required',
            'tanggal_meninggal' => 'required',
            'tempat_meninggal' => 'required',
            'nik' => 'required',
            'agama' => 'required',
            'nama_tpu' => 'required',
            'blok_makam' => 'required',
            'retribusi' => 'required',
            'ambulance' => 'required',
        ];
        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'unique'    => ':attribute sudah digunakan',

        ];
        $attributeNames = array(
            'id_ahliwaris' => 'Nama Ahli Waris',
            'nama_meninggal' => 'Nama Meninggal',
            'tanggal_meninggal' => 'Tanggal Meninggal',
            'tempat_meninggal' => 'Tempat Meninggal',
            'nik' => 'NIK',
            'agama' => 'agama',
            'nama_tpu' => 'Nama TPU',
            'blok_makam' => 'Blok Makam',
            'retribusi' => 'Retribusi',
            'ambulance' => 'ambulance',      
        );
    
        $valid = $this->validate($request, $rules, $customMessages, $attributeNames);
        $registrasi = Registrasi::updateOrCreate(
            [
                'id' => $regId,
            ],
            [
            'kode_registrasi' => $kodeReg,
            'id_ahliwaris' => $request->id_ahliwaris,
            'nama_meninggal' => $request->nama_meninggal,
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'tempat_meninggal' => $request->tempat_meninggal,
            'nik' => $request->nik,
            'agama' => $request->agama,
            'nama_tpu' => $request->nama_tpu,
            'blok_makam' => $request->blok_makam,
            'retribusi' => str_replace($string, '', $request->retribusi),
            'ambulance' => str_replace($string, '', $request->ambulance)
        ]);  
        $herregistrasi = Herregistrasi::updateOrCreate([
            'registrasi_id' => $registrasi->id,
            
        ],
        [
            'nominal' => $nominal
        ]);
        $order = Order::updateOrCreate([
            'registrasi_id' => $registrasi->id,
            'number' => 'DPKP-'.rand(0000,9999),

        ],
        [
            'total_price' => $nominal,
            'payment_status' => 1,

        ]);




        return Response()->json($registrasi);
        // return back()->with('pesan','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function show(Registrasi $registrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrasi $registrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $registrasi  = Registrasi::with('ahliwaris')->where($where)->first();
      
        return Response()->json($registrasi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //hapus
        $data = Registrasi::where('id',$request->id)->delete();
      
        return Response()->json($data);
    }

    public function chart(Request $request)
    {
        $data = Registrasi::where(DB::raw("DATE_FORMAT(tanggal_meninggal, '%Y')"), $request->tahun)->select(
            DB::raw('sum(retribusi+ambulance) as total'), 
            DB::raw("DATE_FORMAT(tanggal_meninggal,'%M') as bulan"),
            )
            ->groupBy('bulan')
            ->get();        
            return response()->json($data);
    }

    public function detail(Request $request)
    {
        $data = Registrasi::with('ahliwaris','tpu','order')->where('id', $request->id)->first();
        return view('pages.makam.detail', compact('data'));
    }
}
