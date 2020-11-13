<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penawaran;
use Yajra\DataTables\Facades\DataTables;

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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
