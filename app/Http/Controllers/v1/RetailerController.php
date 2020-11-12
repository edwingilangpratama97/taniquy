<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Provinsi;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Retailer::with('desa')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<span><a href="/v1/retailer/'.$data->id.'/edit" data-toggle="tooltip" class="text-dark" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;<a data-toggle="tooltip" data-placement="top" onclick="sweet('.$data->id.')" title="Delete" style="cursor: pointer; margin-left: 2px;"><i class="fas fa-trash color-danger"></i></a></span>';
                })
                ->make(true);
        }
        return view('app.middleMan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();
        return view('app.middleMan.create',compact('provinsi'));
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
            'id_desa' => 'required',
            'nama' => 'required|string|max:100',
            'jenis_usaha' => 'required|in:PT,CV,Perorangan',
            'kontak' => 'required|numeric|max:12|',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            $retailer = Retailer::count();
            $date = date("Ymd");
            $kode = sprintf("RT".$date."%'.04d\n", $retailer+1);

            if ($request->file()) {
                $name = $request->file('foto');
                $foto = time()."_".$name->getClientOriginalName();
                $request->foto->move(public_path("upload/foto/Retailer"), $foto);
                Retailer::create(array_merge($request->only('id_desa','nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                    'foto' => 'upload/foto/retailer/'.$foto,
                    'kode_retailer' => $kode
                ]));
            } else {
                Retailer::create(array_merge($request->only('id_desa','nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                    'foto' => 'upload/foto/retailer/'.$foto,
                    'kode_retailer' => $kode
                ]));
            }
            return redirect('v1/retailer')->with('success',  __('Create Data Berhasil.'));
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
        $desa = Desa::all();
        $data = Retailer::find($id);
        return view('app.middleMan.edit',compact('desa','data'));
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
            'id_desa' => 'required',
            'nama' => 'required|string|max:100',
            'jenis_usaha' => 'required|in:PT,CV,Perorangan',
            'kontak' => 'required|numeric|max:12|',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            $data = Retailer::find($id);

            if ($request->file != '') {
                $path = public_path().'/upload/foto/retailer';
                if ($data->file != ''  && $data->file != null) {
                    $file_old = $path.$data->file;
                    unlink($file_old);
                }
                $file = $request->file;
                $filename = $file->getClientOriginalName();
                $file->move($path,$filename);

                $data->update(array_merge($request->only('id_desa','nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                    'foto' => $filename
                ]));

            }
            return back()->with('success',  __('Successfully updated data.'));
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
        Retailer::find($id)->delete();

        return back()->with('success', __('Successfully deleted data.'));
    }
}
