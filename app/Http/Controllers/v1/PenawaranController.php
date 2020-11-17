<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penawaran;
use App\Models\Kebutuhan;
use App\Models\KelompokTani;
use App\Models\Retailer;
use App\Models\Mangga;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class PenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Penawaran::with('kebutuhan','kelompok','mangga','retailer')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('penjual', function($data){
                    if ($data->id_kelompok != null) {
                        return 'Kelompk Tani : '.$data->kelompok->nama;
                    } else {
                        return 'Retailer : '.$data->retailer->nama;
                    }
                })
                ->addColumn('status', function($data){
                    if ($data->status_penerimaan == 0 && $data->status_pembayaran == 0) {
                        return 'Belum Diterima, Belum Dibayar';
                    } elseif ($data->status_penerimaan == 0 && $data->status_pembayaran == 1){
                        return 'Belum Diterima, Sudah Dibayar';
                    } elseif ($data->status_penerimaan == 1 && $data->status_pembayaran == 1) {
                        return 'Sudah Dibayar, Sudah Diterima';
                    }
                })
                ->addColumn('action', function($data){
                    return '<span><a href="#" class="text-warning" data-toggle="modal" data-target="#warning" onclick="getPenawaran('.$data->id.')"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/penawaran/'.$data->id.'/edit" data-toggle="tooltip" class="text-primary" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                })
                ->make(true);
        }
        return view('app.penawaran.index');
    }

    public function getManggaPenawaran($id)
    {
        if($id == 'retailer'){
            $penjual = Retailer::all();
            $data = Mangga::with('jenis')->whereNull('id_kelompok')->get();
            $kebutuhan = Kebutuhan::whereNull('id_retailer')->get();
        } elseif($id == 'kelompok'){
            $penjual = KelompokTani::all();
            $data = Mangga::with('jenis')->whereNull('id_retailer')->get();
            $kebutuhan = Kebutuhan::whereNull('id_enduser')->get();
        }

        return response()->json([
            'code' => 200,
            'data' => $data,
            'kebutuhan' => $kebutuhan,
            'penjual' => $penjual
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.penawaran.create');
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
            'id_kebutuhan' => 'required',
            'role' => 'required',
            'id_mangga' => 'required',
            'penjual' => 'required'
        ]);


        if ($v->fails()) {
            dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            // $postingan = Postingan::where('id',$request->id_postingan)->first();

            if($request->role == 'retailer') {
                $penawaran = Penawaran::count();
                $date = date("Ymd");
                $kode = sprintf("PNR".$date."%'.04d", $penawaran+1);
                // dd($kode);
                $create = Penawaran::create([
                    'kode_penawaran' => $kode,
                    'id_kebutuhan' => $request->id_kebutuhan,
                    'id_retailer' => $request->penjual,
                    'id_mangga' => $request->id_mangga
                ]);
                Notification::create([
                    'id_penawaran' => $create->id,
                    'waktu' => \Carbon\Carbon::now(),
                ]);
            } elseif ($request->role == 'kelompok') {
                $penawaran = Penawaran::count();
                $date = date("Ymd");
                $kode = sprintf("PNK".$date."%'.04d", $penawaran+1);
                // dd($kode);
                $create = Penawaran::create([
                    'kode_penawaran' => $kode,
                    'id_kebutuhan' => $request->id_kebutuhan,
                    'id_kelompok' => $request->penjual,
                    'id_mangga' => $request->id_mangga
                ]);
                Notification::create([
                    'id_penawaran' => $create->id,
                    'waktu' => \Carbon\Carbon::now(),
                ]);
            }

            if ($create = true) {
                return redirect('v1/penawaran')->with('success',  __('Create Data Berhasil.'));
            } else {
                return redirect('v1/penawaran')->with('failed',  __('Create Data Gagal.'));
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
        $data = Penawaran::with('kelompok','kebutuhan','retailer','mangga')->where('id',$id)->first();
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
        $data = Penawaran::find($id);
        if($data->id_kelompok != null ){
            $mangga = Mangga::where('id_kelompok', $data->id_kelompok)->get();
        } elseif ($data->id_retailer != null) {
            $mangga = Mangga::where('id_retailer', $data->id_retailer)->get();
        }
        // dd($mangga);
        return view('app.penawaran.edit', compact('data','mangga'));
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
        $penawaran = Penawaran::find($id);

        $v = Validator::make($request->all(),[
            'id_mangga' => 'required',
            'status_pembayaran' => 'required',
            'status_penerimaan' => 'required'
        ]);

        if ($v->fails()) {
            // dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            $update = $penawaran->update($request->only('id_mangga','status_pembayaran','status_penerimaan'));

            if ($update = true) {
                return redirect('v1/penawaran')->with('success',  __('Update Data Berhasil.'));
            } else {
                return redirect('v1/penawaran')->with('failed',  __('Update Data Gagal.'));
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
        $delete = Penawaran::find($id)->delete();

        if ($delete = true) {
            return redirect('v1/penawaran')->with('success',  __('Delete Data Berhasil.'));
        } else {
            return redirect('v1/penawaran')->with('failed',  __('Delete Data Gagal.'));
        }
    }
}
