<?php

namespace App\Http\Controllers;

use App\Models\AhliWaris;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class AhliWarisController extends Controller
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
        if ($request->ajax()) {
            $ahliWaris = AhliWaris::select(
                'id',
                'nama',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat',
                'agama',
                'nomor_telepon',
            );
            return Datatables::of($ahliWaris)
            ->addIndexColumn()
            ->addColumn('action', function(AhliWaris $ahliWaris){
                    $actionBtn = '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opsi <i class="mdi mdi-chevron-down"></i></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="update('.$ahliWaris->id.')">Ubah</a>
                        <a class="dropdown-item btn-hapus" href="javascript:void(0)" onclick="hapus('.$ahliWaris->id.')">Hapus</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>';
                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.ahliwaris.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ahliwaris.add');
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
            'nama' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'nomor_telepon' => 'required',
        ];
    
        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'unique'    => ':attribute sudah digunakan',

        ];
        $attributeNames = array(
            'nama' => 'Nama',
            'nik' => 'NIK',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'agama' => 'Agama',
            'nomor_telepon' => 'Nomor Telepon',      
        );
    
        $valid = $this->validate($request, $rules, $customMessages, $attributeNames);

        $user = User::create([
            'name' => $request->nama,
            'dob'=> $request->tanggal_lahir,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'email_verified_at'=> now(),
            'avatar' => 'assets/images/pemda.png',
            'created_at' => now(),
        ]);

        $ahliWaris = AhliWaris::updateOrCreate(
            [
                'id' => $regId,
            ],
            [
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'nomor_telepon' => $request->nomor_telepon,
        ]);
        return Response()->json($ahliWaris);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AhliWaris  $ahliWaris
     * @return \Illuminate\Http\Response
     */
    public function show(AhliWaris $ahliWaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AhliWaris  $ahliWaris
     * @return \Illuminate\Http\Response
     */
    public function edit(AhliWaris $ahliWaris)
    {
        return view('pages.ahliwaris.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AhliWaris  $ahliWaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $ahliWaris  = AhliWaris::where($where)->first();
      
        return Response()->json($ahliWaris);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AhliWaris  $ahliWaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $data = AhliWaris::where('id',$request->id)->delete();
        return Response()->json($data);
    }

    public function search(Request $request)
    {
        $aw = AhliWaris::where('nama', 'LIKE', '%'.$request->input('q', '').'%')
        ->get(['id', 'nama as text']);
        
        return ['results' => $aw];
    }
}
