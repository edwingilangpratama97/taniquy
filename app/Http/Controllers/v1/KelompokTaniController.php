<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelompokTani;
use Illuminate\Support\Facades\Validator;
use DataTables;

class KelompokTaniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KelompokTani::with('desa')->latest()->get();
        // dd($data);
        if($request->ajax()){
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    // return '<span><a href="/v1/kelompok/'.$data->id.'/edit" data-toggle="tooltip" class="text-dark" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                    return '<a href="/v1/kelompok/'.$data->id.'" class="text-warning"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/kelompok/'.$data->id.'/edit" class="text-primary"><i class="fa fa-edit"></i></a>&nbsp;<a href="#" class="text-danger" onclick="sweet('.$data->id.')"><i class="fa fa-trash"></i></a>';
                })
                ->make(true);
        }
        // dd($count);

        return view('app.kelompok.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.kelompok.create');
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
        $data = KelompokTani::where('id',$id)->first();
        return view('app.kelompok.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KelompokTani::where('id',$id)->first();
        return view('app.kelompok.edit');
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
        $data = KelompokTani::where('id',$id)->first();
        $data->delete();  
    }
}
