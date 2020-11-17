<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisMangga;
use App\Models\Kebutuhan;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class KebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Kebutuhan::with('enduser','retailer','jenis')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pembeli', function($data){
                    if ($data->id_enduser != null) {
                        return 'Pelanggan : '.$data->enduser->nama;
                    } else {
                        return 'Retailer : '.$data->retailer->nama;
                    }
                })
                ->addColumn('action', function($data){
                    return '<span><a href="/v1/kebutuhan/'.$data->id.'/edit" data-toggle="tooltip" class="text-primary" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                })
                ->make(true);
        }
        return view('app.kebutuhan.index');
    }

    public function postKebutuhan(Request $request)
    {
        // dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisMangga::all();
        return view('app.kebutuhan.create',compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $v = Validator::make($request->all(),[
            'id_jenis' => 'required',
            'pemesan' => 'required',
            'jumlah' => 'required'
        ]);


        if ($v->fails()) {
            // dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            // $postingan = Postingan::where('id',$request->id_postingan)->first();

            if($request->role == 'retailer') {
                $kebutuhan = Kebutuhan::count();
                $date = date("Ymd");
                $kode = sprintf("KR".$date."%'.04d", $kebutuhan+1);
                // dd($kode);
                $create = Kebutuhan::create([
                    'kode_kebutuhan' => $kode,
                    'id_jenis' => $request->id_jenis,
                    'id_retailer' => $request->pemesan,
                    'jumlah' => $request->jumlah
                ]);
            } elseif ($request->role == 'enduser') {
                $kebutuhan = Kebutuhan::count();
                $date = date("Ymd");
                $kode = sprintf("KE".$date."%'.04d", $kebutuhan+1);
                // dd($kode);
                $create = Kebutuhan::create([
                    'kode_kebutuhan' => $kode,
                    'id_jenis' => $request->id_jenis,
                    'id_enduser' => $request->pemesan,
                    'jumlah' => $request->jumlah
                ]);
            }
            if (Auth::user()->role != 'admin') {
                return redirect('v1/dashboard')->with('success',  __('Post Berhasil.'));
            }
            if ($create = true) {
                return redirect('v1/kebutuhan')->with('success',  __('Create Data Berhasil.'));
            } else {
                return redirect('v1/kebutuhan')->with('failed',  __('Create Data Gagal.'));
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
        //
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
        $data = Kebutuhan::find($id);
        if($data->id_retailer != null) {
            $role = "Retailer";
            $pemesan = $data->retailer;
        } elseif ($data->id_enduser != null) {
            $role = "Pelanggan (Enduser)";
            $pemesan = $data->enduser;
        }
        // dd($pemesan);
        return view('app.kebutuhan.edit',compact('data','jenis','pemesan','role'));
        // $data = Kebutuhan::find($id);
        // return view('app.kebutuhan.edit', compact('data'));
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
            'jenis' => 'required',
            'jumlah' => 'required',
        ]);

        if ($v->fails()) {
            // dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
        // dd($request->all());
            $kebutuhan = Kebutuhan::where('id',$id);
            if($request->id_retailer != null) {
                // dd($kode);
                $update = $kebutuhan->update([
                    'id_jenis' => $request->jenis,
                    // 'id_retailer' => $request->id_retailer,
                    'jumlah' => $request->jumlah
                ]);
            } elseif ($request->id_kelompok != null) {
                // dd($kode);
                $update = $kebutuhan->update([
                    'id_jenis' => $request->jenis,
                    // 'id_kelompok' => $request->id_kelompok,
                    'jumlah' => $request->jumlah
                ]);
            }

            if ($update = true) {
                return redirect('v1/kebutuhan')->with('success',  __('Update Data Berhasil.'));
            } else {
                return redirect('v1/kebutuhan')->with('failed',  __('Update Data Gagal.'));
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
        $delete = Kebutuhan::find($id)->delete();

        if ($delete = true) {
            return redirect('v1/kebutuhan')->with('success',  __('Delete Data Berhasil.'));
        } else {
            return redirect('v1/kebutuhan')->with('failed',  __('Delete Data Gagal.'));
        }
    }
}
