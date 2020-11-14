<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Mangga;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Postingan::with('kelompok','retailer','mangga')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('penjual', function($data){
                    if ($data->id_kelompok != null) {
                        return 'Kelompok Tani : '.$data->kelompok->nama;
                    } else {
                        return 'Retailer : '.$data->retailer->nama;
                    }
                })
                ->addColumn('action', function($data){
                    return '<span><a href="#" class="text-warning" data-toggle="modal" data-target="#warning" onclick="getPostingan('.$data->id.')"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/postingan/'.$data->id.'/edit" data-toggle="tooltip" class="text-primary" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                })
                ->make(true);
        }
        return view('app.postingan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $id_kelompok = $auth->id_kelompok;
        $id_retailer = $auth->id_retailer;
        if ($id_kelompok != null) {
            $mangga = Mangga::where('id_kelompok', $id_kelompok)->get();
        } elseif ($id_retailer != null) {
            $mangga = Mangga::where('id_retailer', $id_retailer)->get();
        } else {
            $mangga = Mangga::all();
        }
        return view('app.postingan.create',compact('mangga'));
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
            'id_mangga' => 'required',
            'keterangan' => 'required',
        ]);

        if ($v->fails()) {
            // dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            $mangga = Mangga::where('id',$request->id_mangga)->first();

            if($mangga->id_retailer != null) {
                $postingan = Postingan::count();
                $date = date("Ymd");
                $kode = sprintf("POR".$date."%'.04d", $postingan+1);
                // dd($kode);
                $create = Postingan::create([
                    'kode_postingan' => $kode,
                    'id_mangga' => $request->id_mangga,
                    'id_retailer' => $mangga->id_retailer,
                    'keterangan' => $request->keterangan
                ]);
            } elseif ($mangga->id_kelompok != null) {
                $postingan = Postingan::count();
                $date = date("Ymd");
                $kode = sprintf("POK".$date."%'.04d", $postingan+1);
                // dd($kode);
                $create = Postingan::create([
                    'kode_postingan' => $kode,
                    'id_mangga' => $request->id_mangga,
                    'id_kelompok' => $mangga->id_kelompok,
                    'keterangan' => $request->keterangan
                ]);
            }

            if ($create = true) {
                return redirect('v1/postingan')->with('success',  __('Create Data Berhasil.'));
            } else {
                return redirect('v1/postingan')->with('failed',  __('Create Data Gagal.'));
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
        $data = Postingan::with('kelompok','retailer','mangga.jenis','mangga.grade')->where('id',$id)->first();
        return response()->json([
            'data' => $data
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = Auth::user();
        $id_kelompok = $auth->id_kelompok;
        $id_retailer = $auth->id_retailer;
        if ($id_kelompok != null) {
            $mangga = Mangga::where('id_kelompok', $id_kelompok)->get();
        } elseif ($id_retailer != null) {
            $mangga = Mangga::where('id_retailer', $id_retailer)->get();
        } else {
            $mangga = Mangga::all();
        }
        $data = Postingan::find($id);
        return view('app.postingan.edit',compact('mangga','data'));
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
            'id_mangga' => 'required',
            'keterangan' => 'required',
        ]);

        if ($v->fails()) {
            // dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            $mangga = Mangga::where('id',$request->id_mangga)->first();
            $postingan = Postingan::where('id',$id);
            if($mangga->id_retailer != null) {
                // dd($kode);
                $update = $postingan->update([
                    'id_mangga' => $request->id_mangga,
                    'id_retailer' => $mangga->id_retailer,
                    'keterangan' => $request->keterangan
                ]);
            } elseif ($mangga->id_kelompok != null) {
                // dd($kode);
                $update = $postingan->update([
                    'id_mangga' => $request->id_mangga,
                    'id_kelompok' => $mangga->id_kelompok,
                    'keterangan' => $request->keterangan
                ]);
            }

            if ($update = true) {
                return redirect('v1/postingan')->with('success',  __('Update Data Berhasil.'));
            } else {
                return redirect('v1/postingan')->with('failed',  __('Update Data Gagal.'));
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
        $delete = Postingan::find($id)->delete();

        if ($delete = true) {
            return redirect('v1/postingan')->with('success',  __('Delete Data Berhasil.'));
        } else {
            return redirect('v1/postingan')->with('failed',  __('Delete Data Gagal.'));
        }
    }
}
