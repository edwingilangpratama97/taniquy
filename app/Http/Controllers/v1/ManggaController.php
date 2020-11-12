<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\JenisMangga;
use App\Models\KelompokTani;
use App\Models\Mangga;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManggaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Mangga::with('jenis','grade')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<span><a href="#" class="text-warning" data-toggle="modal" data-target="#warning" onclick="getMangga('.$data->id.')"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/mangga/'.$data->id.'/edit" data-toggle="tooltip" class="text-dark" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                })
                ->make(true);
        }
        return view('app.mangga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = Auth::user();
        // dd($user->role);
        $jenis = JenisMangga::all();
        $grade = Grade::all();
        $kelompok = KelompokTani::all();
        $retailer = Retailer::all();

        return view('app.mangga.create',compact('jenis','grade','kelompok','retailer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $v = Validator::make($request->all(),[
            'id_jenis' => 'required',
            'id_grade' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kode_mangga' => 'nullable',
            'id_kelompok' => 'nullable'
        ]);

        if ($v->fails()) {
            // dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        } else {
            $mangga = Mangga::count();
            $date = date("Ymd");
            $kodeKel = sprintf("MK".$date."%'.04d\n", $mangga+1);
            $kodeRet = sprintf("MR".$date."%'.04d\n", $mangga+1);

            $name = $request->file('foto');
            $foto = time()."_".$name->getClientOriginalName();
            $request->foto->move(public_path("upload/foto/Mangga"), $foto);

            $user = Auth::user();
            if ($user->role == 'admin') {
                if ($request->id_kelompok) {
                    Mangga::create(array_merge($request->only('id_jenis','id_grade','harga','stok','role','id_retailer','id_kelompok'),[
                        'foto' => 'upload/foto/Mangga/'.$foto,
                        'kode_mangga' => $kodeKel
                    ]));
                } elseif ($request->id_retailer) {
                    Mangga::create(array_merge($request->only('id_jenis','id_grade','harga','stok','role','id_retailer','id_kelompok'),[
                        'foto' => 'upload/foto/Mangga/'.$foto,
                        'kode_mangga' => $kodeRet
                    ]));
                }
                return back()->with('success','Data Created all !');
            }elseif ($user->role == 'retailer') {
                Mangga::create(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                    'foto' => 'upload/foto/Mangga/'.$foto,
                    'kode_mangga' => $kodeRet,
                    'role' => 'retailer',
                    'id_retailer' => $user->id_retailer
                ]));
                return back()->with('success','Data Created role & id_retail !');
            }elseif ($user->role == 'kelompok') {
                Mangga::create(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                    'foto' => 'upload/foto/Mangga/'.$foto,
                    'kode_mangga' => $kodeKel,
                    'role' => 'kelompok',
                    'id_kelompok' => $user->id_kelompok
                ]));
                return back()->with('success','Data Created role kelompok & id_kelompok !');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Mangga::with('kelompok','jenis','grade','retailer')->where('id',$id)->first();
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = JenisMangga::all();
        $grade = Grade::all();
        $kelompok = KelompokTani::all();
        $retailer = Retailer::all();
        $data = Mangga::find($id);
        // $kel = Mangga::where('id_kelompok',$id)->exists();
        // $ret = Mangga::where('id_retailer',$id)->exists();

        return view('app.mangga.edit',compact('jenis','grade','kelompok','retailer','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(),[
            'id_jenis' => 'required',
            'id_grade' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kode_mangga' => 'nullable',
            'id_kelompok' => 'nullable'
        ]);

        if ($v->fails()) {
            // dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        } else {
            $mangga = Mangga::count();
            $date = date("Ymd");
            $kodeKel = sprintf("MK".$date."%'.04d\n", $mangga+1);
            $kodeRet = sprintf("MR".$date."%'.04d\n", $mangga+1);

            $user = Auth::user();
            $mangga = Mangga::find($id);
            // dd($mangga->foto);
            if ($user->role == 'admin') {
                if ($request->foto != '') {
                    $name = $request->file('foto');
                    $foto = time()."_".$name->getClientOriginalName();
                    $request->foto->move(public_path("upload/foto/Mangga"), $foto);

                    $mangga->update(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                        'foto' => 'upload/foto/Mangga/'.$foto,
                    ]));
                    return back()->with('success','Data Updated all with foto !');
                } else {
                    $mangga->update(array_merge($request->only('id_jenis','id_grade','harga','stok','role')));
                    return back()->with('success','Data Updated all !');
                }
            }elseif ($user->role == 'retailer') {
                if ($request->foto != '') {
                    $name = $request->file('foto');
                    $foto = time()."_".$name->getClientOriginalName();
                    $request->foto->move(public_path("upload/foto/Mangga"), $foto);

                    $mangga->update(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                        'foto' => 'upload/foto/Mangga/'.$foto,
                        'kode_mangga' => $kodeRet,
                        'role' => 'retailer',
                        'id_retailer' => $user->id_retailer
                        ]));
                        return back()->with('success','Data Created with Foto !');
                }else {
                    $mangga->update(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                        'kode_mangga' => $kodeRet,
                        'role' => 'retailer',
                        'id_retailer' => $user->id_retailer
                    ]));
                    return back()->with('success','Data Created !');
                }
            }elseif ($user->role == 'kelompok') {
                if ($request->foto != '') {
                    $name = $request->file('foto');
                    $foto = time()."_".$name->getClientOriginalName();
                    $request->foto->move(public_path("upload/foto/Mangga"), $foto);

                    $mangga->update(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                        'foto' => 'upload/foto/Mangga/'.$foto,
                        'kode_mangga' => $kodeKel,
                        'role' => 'kelompok',
                        'id_kelompok' => $user->id_kelompok
                    ]));
                    return back()->with('success','Data Created with foto !');
                } else {
                    $mangga->update(array_merge($request->only('id_jenis','id_grade','harga','stok','role'),[
                        'kode_mangga' => $kodeKel,
                        'role' => 'kelompok',
                        'id_kelompok' => $user->id_kelompok
                    ]));
                    return back()->with('success','Data Created !');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mangga::find($id)->delete();

        return back()->with('success', __('successfully Delete Data'));
    }
}
