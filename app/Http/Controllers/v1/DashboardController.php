<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\KelompokTani;
use App\Models\Kebutuhan;
use App\Models\Postingan;
use App\Models\Retailer;
use App\Models\Enduser;
use App\Models\Provinsi;
use App\Models\Mangga;
use App\Models\JenisMangga;
use App\User;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = Provinsi::all();
        $jenis = JenisMangga::all();
        $auth = Auth::user();
        $postinganKelompok = Postingan::with('kelompok.desa.kecamatan','mangga.jenis')->where('id_kelompok','!=',null)->get();
        $postinganRetailer = Postingan::with('retailer.desa.kecamatan','mangga.jenis')->where('id_retailer','!=',null)->get();
        $kebutuhanRetailer = Kebutuhan::with('retailer.desa.kecamatan','jenis')->where('id_retailer','!=',null)->get();
        $kebutuhanEnduser = Kebutuhan::with('enduser.desa.kecamatan','jenis')->where('id_enduser','!=',null)->get();
        if ($auth->id_kelompok != null) {
            $mangga = Mangga::where('id_kelompok', Auth::user()->id_kelompok)->get();
            if($auth->kelompok->kontak == null || $auth->kelompok->latitude == null || $auth->kelompok->longitude == null){
                return view('app.account.complete', compact('provinsi','auth'));
            }
            return view('app.dashboard', compact('jenis','kebutuhanRetailer','mangga'));
        }else if ($auth->id_retailer != null) {
            $mangga = Mangga::where('id_retailer', Auth::user()->id_retailer)->get();
            if($auth->retailer->kontak == null || $auth->retailer->latitude == null || $auth->retailer->longitude == null){
                return view('app.account.complete', compact('provinsi','auth'));
            }
            return view('app.dashboard', compact('jenis','postinganKelompok','kebutuhanEnduser','mangga'));
        } elseif ($auth->id_enduser != null) {
            if($auth->enduser->kontak == null || $auth->enduser->latitude == null || $auth->enduser->longitude == null){
                return view('app.account.complete', compact('provinsi','auth'));
            }
            return view('app.dashboard', compact('jenis','postinganRetailer'));
        } else {
            $mangga = Mangga::all();
            // echo "Anda Sang Dewa";
            return view('app.dashboard', compact('mangga','jenis','postinganKelompok','postinganRetailer','kebutuhanEnduser','kebutuhanRetailer'));
        }
        // return view('app.dashboard');
    }

    public function completeAccount(Request $request, $id)
    {
        $data = User::find($id);
        // dd($request->all(),$data);

        if ($request->role == 'enduser') {
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
                $data = Enduser::find($data->id_enduser);
                // dd($data);

                if ($request->file('foto') != '') {
                    $name = $request->file('foto');
                    $foto = time()."_".$name->getClientOriginalName();
                    $request->foto->move(public_path("upload/foto/enduser"), $foto);
                    if ($request->desa == null) {
                        $data->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                            'foto' => 'upload/foto/enduser/'.$foto,
                        ]));
                    } else {
                        $data->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                            'foto' => 'upload/foto/enduser/'.$foto,
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
            }
        } elseif($request->role == 'retailer') {
            $v = Validator::make($request->all(),[
                'desa' => 'nullable',
                'kecamatan' => 'nullable',
                'kabupaten' => 'nullable',
                'provinsi' => 'nullable',
                'nama' => 'required|string|max:100',
                'jenis_usaha' => 'required|in:PT,CV,Perorangan',
                'kontak' => 'required|numeric',
                'alamat' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            } else {
                $data = Retailer::find($data->id_retailer);

                if ($request->file('foto') != '') {
                    $name = $request->file('foto');
                    $foto = time()."_".$name->getClientOriginalName();
                    $request->foto->move(public_path("upload/foto/retailer"), $foto);
                    if ($request->desa == null) {
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                            'foto' => 'upload/foto/retailer/'.$foto,
                            'id_desa' => $request->desa
                        ]));
                    } else {
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                            'foto' => 'upload/foto/retailer/'.$foto,
                            'id_desa' => $request->desa
                        ]));
                    }

                } else {
                    if ($request->desa == null) {
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude')));
                    } else {
                        // dd($request->all());
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                            'id_desa' => $request->desa
                        ]));
                    }
                }
            }
        } elseif($request->role == 'kelompok') {
            $v = Validator::make($request->all(),[
                'desa' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'provinsi' => 'required',
                'nama' => 'required|string|max:100',
                'ketua' => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'foto_ketua' => 'nullable|image|max:2048'
            ]);

            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            } else {
                $data = KelompokTani::find($data->id_kelompok);

                if ($request->file('foto_ketua') != '') {
                    $name = $request->file('foto_ketua');
                    $foto_ketua = time()."_".$name->getClientOriginalName();
                    $request->foto_ketua->move(public_path("upload/foto/kelompok"), $foto_ketua);
                    if ($request->desa == null) {
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude','ketua'),[
                            'foto_ketua' => 'upload/foto/kelompok/'.$foto_ketua
                        ]));
                    } else {
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude','ketua'),[
                            'foto_ketua' => 'upload/foto/kelompok/'.$foto_ketua,
                            'id_desa' => $request->desa
                        ]));
                    }

                } else {
                    if ($request->desa == null) {
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude','ketua')));
                    } else {
                        // dd($request->all());
                        $data->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude','ketua'),[
                            'id_desa' => $request->desa
                        ]));
                    }
                }
            }
        }

        if ($data = true) {
            return redirect('v1/dashboard')->with('success',  __('Update Data Berhasil.'));
        } else {
            return redirect('v1/dashboard')->with('failed',  __('Update Data Gagal.'));
        }
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
