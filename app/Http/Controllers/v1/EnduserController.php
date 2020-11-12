<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Enduser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EnduserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Enduser::with('desa')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a href="#" class="text-warning" data-toggle="modal" data-target="#warning" onclick="getEnduser('.$data->id.')"><i class="fa fa-eye"></i></a>&nbsp;<a href="/v1/customer/'.$data->id.'/edit" class="text-primary"><i class="fa fa-edit"></i></a>&nbsp;<a href="#" class="text-danger" onclick="sweet('.$data->id.')"><i class="fa fa-trash"></i></a>';
                })
                ->make(true);
        }
        return view('app.endUser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();
        return view('app.endUser.create',compact('provinsi'));
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
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'kontak' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($v->fails()) {
            dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        } else {
            // dd($request->file('foto'));
            $enduser = Enduser::count();
            $date = date("Ymd");
            $kode = sprintf("EU".$date."%'.04d\n", $enduser+1);
            if ($request->file('foto')) {
                $name = $request->file('foto');
                $foto = time()."_".$name->getClientOriginalName();
                $request->foto->move(public_path("upload/foto/enduser"), $foto);
                $create = Enduser::create(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                    'foto' => 'upload/foto/enduser/'.$foto,
                    'kode_enduser' => $kode,
                    'id_desa' => $request->desa
                ]));
            } else {
                $create = Enduser::create(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                    'kode_enduser' => $kode,
                    'id_desa' => $request->desa
                ]));
            }

            if ($create = true) {
                return redirect('v1/customer')->with('success',  __('Create Data Berhasil.'));
            } else {
                return redirect('v1/customer')->with('failed',  __('Create Data Gagal.'));
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
        $data = Enduser::with('desa.kecamatan.kabupaten.provinsi')->where('id',$id)->first();
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
        $provinsi = Provinsi::all();
        $data = Enduser::find($id);
        return view('app.endUser.edit',compact('provinsi','data'));
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
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kontak' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            $data = Enduser::find($id);

            if ($request->file('foto') != '') {
                $name = $request->file('foto');
                $foto = time()."_".$name->getClientOriginalName();
                $request->foto->move(public_path("upload/foto/enduser"), $foto);
                if ($request->desa == null) {
                    $data->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                        'foto' => $filename,
                    ]));
                } else {
                    $data->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                        'foto' => $filename,
                        'id_desa' => $request->desa
                    ]));
                }

            } else {
                if ($request->desa == null) {
                    $data->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude')));
                } else {
                    // dd($request->all());
                    $data->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                        'id_desa' => $request->desa
                    ]));
                }
            }
            if ($data = true) {
                return redirect('v1/customer')->with('success',  __('Update Data Berhasil.'));
            } else {
                return redirect('v1/customer')->with('failed',  __('Update Data Gagal.'));
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
        Enduser::find($id)->delete();

        return back()->with('success', __('Successfully deleted data.'));
    }
}
