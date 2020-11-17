<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Retailer;
use App\Models\Enduser;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Postingan;
use Yajra\DataTables\Facades\DataTables;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Pemesanan::with('enduser','retailer','postingan')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pembeli', function($data){
                    if ($data->id_enduser != null) {
                        return 'Pelanggan : '.$data->enduser->nama;
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
                    return '<span><a href="#" class="text-warning" data-toggle="modal" data-target="#warning" onclick="getPemesanan('.$data->id.')"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/pemesanan/'.$data->id.'/edit" data-toggle="tooltip" class="text-primary" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                })
                ->make(true);
        }
        return view('app.pemesanan.index');
    }

    public function getPemesan($id)
    {
        if($id == 'retailer'){
            $data = Retailer::all();
            $postingan = Postingan::with('kelompok','mangga.jenis')->whereNull('id_retailer')->get();
        } elseif($id == 'enduser'){
            $data = Enduser::all();
            $postingan = Postingan::with('retailer','mangga.jenis')->whereNull('id_kelompok')->get();
        }

        return response()->json([
            'code' => 200,
            'data' => $data,
            'postingan' => $postingan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $id_enduser = $auth->id_enduser;
        $id_retailer = $auth->id_retailer;
        if ($id_enduser != null) {
            $postingan = Postingan::whereNull('id_kelompok')->get();
        } elseif ($id_retailer != null) {
            $postingan = Postingan::whereNull('id_retailer')->get();
        } else {
            $postingan = Postingan::all();
        }
        return view('app.pemesanan.create',compact('postingan'));
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
            'id_postingan' => 'required',
            'pemesan' => 'required',
            'jumlah' => 'required'
        ]);


        if ($v->fails()) {
            // dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            // $postingan = Postingan::where('id',$request->id_postingan)->first();

            if($request->role == 'retailer') {
                $pemesanan = Pemesanan::count();
                $date = date("Ymd");
                $kode = sprintf("PER".$date."%'.04d", $pemesanan+1);
                // dd($kode);
                $create = Pemesanan::create([
                    'kode_pemesanan' => $kode,
                    'id_postingan' => $request->id_postingan,
                    'id_retailer' => $request->pemesan,
                    'jumlah' => $request->jumlah
                ]);
                Notification::create([
                    'id_pemesanan' => $create->id,
                    'waktu' => \Carbon\Carbon::now(),
                ]);
            } elseif ($request->role == 'enduser') {
                $pemesanan = Pemesanan::count();
                $date = date("Ymd");
                $kode = sprintf("PEE".$date."%'.04d", $pemesanan+1);
                // dd($kode);
                $create = Pemesanan::create([
                    'kode_pemesanan' => $kode,
                    'id_postingan' => $request->id_postingan,
                    'id_enduser' => $request->pemesan,
                    'jumlah' => $request->jumlah
                ]);
                Notification::create([
                    'id_pemesanan' => $create->id,
                    'waktu' => \Carbon\Carbon::now(),
                ]);
            }

            if ($create = true) {
                return redirect('v1/pemesanan')->with('success',  __('Create Data Berhasil.'));
            } else {
                return redirect('v1/pemesanan')->with('failed',  __('Create Data Gagal.'));
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
        $data = Pemesanan::with('enduser','postingan.mangga','retailer')->where('id',$id)->first();
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

        $data = Pemesanan::find($id);
        $auth = Auth::user();
        $id_enduser = $auth->id_enduser;
        $id_retailer = $auth->id_retailer;
        if ($id_enduser != null) {
            $postingan = Postingan::whereNull('id_kelompok')->get();
        } elseif ($id_retailer != null) {
            $postingan = Postingan::whereNull('id_retailer')->get();
        } else {
            $postingan = Postingan::where('id',$data->postingan->id)->first();
        }
        if($data->id_retailer != null) {
            $role = "Retailer";
            $pemesan = $data->retailer;
        } elseif ($data->id_enduser != null) {
            $role = "Pelanggan (Enduser)";
            $pemesan = $data->enduser;
        }
        // dd($pemesan);
        return view('app.pemesanan.edit',compact('postingan','data','pemesan','role'));
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
            'jumlah' => 'required',
            'status_pembayaran' => 'required',
            'status_penerimaan' => 'required'
        ]);

        if ($v->fails()) {
            dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            $pemesanan = Pemesanan::where('id',$id);
            $update = $pemesanan->update($request->only('jumlah','status_pembayaran','status_penerimaan'));

            if ($update = true) {
                return redirect('v1/pemesanan')->with('success',  __('Update Data Berhasil.'));
            } else {
                return redirect('v1/pemesanan')->with('failed',  __('Update Data Gagal.'));
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
        $delete = Pemasangan::find($id)->delete();

        if ($delete = true) {
            return redirect('v1/pemasangan')->with('success',  __('Delete Data Berhasil.'));
        } else {
            return redirect('v1/pemasangan')->with('failed',  __('Delete Data Gagal.'));
        }
    }
}
