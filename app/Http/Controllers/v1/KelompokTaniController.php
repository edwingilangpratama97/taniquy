<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelompokTani;
use App\Models\Provinsi;
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
                    return '<a href="#" class="text-warning" onclick="detail('.$data->id.')"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/kelompok/'.$data->id.'/edit" class="text-primary"><i class="fa fa-edit"></i></a>&nbsp;<a href="#" class="text-danger" onclick="sweet('.$data->id.')"><i class="fa fa-trash"></i></a>';
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
        $provinsi = Provinsi::all();
        return view('app.kelompok.create', compact('provinsi'));
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
            'ketua' => 'required|string|max:100',
            'kontak' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto_ketua' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($v->fails()) {
            dd($v->errors($v)->all());
            return back()->withErrors($v)->withInput();
        } else {
            // dd($request->all());
            $retailer = KelompokTani::count();
            $date = date("Ymd");
            $kode = sprintf("KT".$date."%'.04d\n", $retailer+1);

            if ($request->file()) {
                $name = $request->file('foto_ketua');
                $foto_ketua = time()."_".$name->getClientOriginalName();
                $request->foto_ketua->move(public_path("upload/foto/kelompok"), $foto_ketua);
                $create = KelompokTani::create(array_merge($request->only('id_desa','nama','ketua','kontak','alamat','latitude','longitude'),[
                    'foto_ketua' => 'upload/foto/retailer/'.$foto_ketua,
                    'kode_kelompok' => $kode
                ]));
            } else {
                $create = KelompokTani::create(array_merge($request->only('id_desa','nama','ketua','kontak','alamat','latitude','longitude'),[
                    'kode_kelompok' => $kode
                ]));
            }

            if ($create = true) {
                return redirect('v1/kelompok')->with('success',  __('Create Data Berhasil.'));
            } else {
                return redirect('v1/kelompok')->with('failed',  __('Create Data Gagal.'));
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
        $data = KelompokTani::where('id',$id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KelompokTani::find($id);
        return view('app.kelompok.edit', compact($data));
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
            'ketua' => 'required|string|max:100',
            'kontak' => 'required|numeric|max:12|',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto_ketua' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            $data = KelompokTani::find($id);

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
            if ($data = true) {
                return redirect('v1/kelompok')->with('success',  __('Update Data Berhasil.'));
            } else {
                return redirect('v1/kelompok')->with('failed',  __('Update Data Gagal.'));
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
        $delete = KelompokTani::find($id)->delete();

        if ($delete = true) {
            return redirect('v1/kelompok')->with('success',  __('Delete Data Berhasil.'));
        } else {
            return redirect('v1/kelompok')->with('failed',  __('Delete Data Gagal.'));
        }
    }
}
