<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Enduser;
use App\Models\KelompokTani;
use App\Models\Provinsi;
use App\Models\Retailer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function account()
    {
        return view('app.account.index');
    }
    public function updateAccountRetailer()
    {
        $auth = Auth::user();
        $retailer = Retailer::where('id',$auth->retailer->id)->first();
        // dd($retailer->latitude);
        $provinsi = Provinsi::all();
        $data = User::find($auth->id);
        return view('app.account.updateAccountRetailer',compact('retailer','provinsi','data'));
    }
    public function updateAccountKelompok()
    {
        $auth = Auth::user();
        // dd($retailer->latitude);
        $kelompok = KelompokTani::where('id',$auth->kelompok->id)->first();
        $provinsi = Provinsi::all();
        $data = User::find($auth->id);
        return view('app.account.updateAccountKelompok',compact('kelompok','provinsi','data'));
    }
    public function updateAccountEnduser()
    {
        $auth = Auth::user();
        $enduser = Enduser::where('id',$auth->id_enduser)->first();
        $provinsi = Provinsi::all();
        $data = User::find($auth->id);
        return view('app.account.updateAccountEnduser',compact('enduser','provinsi','data'));
    }
    public function updateAccountAdmin()
    {
        $data = User::find($auth->id);
        return view('app.account.updateAccountAdmin',compact('data'));
    }
    public function updateAkunAdmin(Request $request, $id)
    {
        if (Auth::user()->role == 'admin') {
            $v = Validator::make($request->all(),[
                'name' => 'required|string|max:50',
                'email' => 'required|unique:users,email,'.$id,
            ]);
        }
        if ($v->fails()) {
            // dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        } else {
            $auth = Auth::user();
            $user = User::find($id);
            if ($auth->role == 'admin') {
                $user->update($request->only('name','email'));
            }
            return redirect('v1/account')->with('success',  __('Update Data Berhasil.'));
        }
    }
    public function updateAkunRetailer(Request $request, $id)
    {
        if (Auth::user()->id_retailer != null) {
            $v = Validator::make($request->all(),[
                'name' => 'required|string|max:50',
                'email' => 'required|unique:users,email,'.$id,
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
        }
        if ($v->fails()) {
            // dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        } else {
            $auth = Auth::user();
            $user = User::find($id);
            if ($auth->id_retailer != null) {
                $retailer = Retailer::where('id',$auth->id_retailer)->first();
                // dd($retailer);

                if ($request->file('foto') != '') {
                    $name = $request->file('foto');
                    $foto = time()."_".$name->getClientOriginalName();
                    $request->foto->move(public_path("upload/foto/retailer"), $foto);
                    if ($request->desa == null) {
                        $retailer->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                            'foto' => 'upload/foto/retailer/'.$foto,
                            'id_desa' => $request->desa
                        ]));
                        $user->update(array_merge($request->only('name','email'),[
                            'id_retailer' => $retailer->id
                        ]));
                    } else {
                        $retailer->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                            'foto' => 'upload/foto/retailer/'.$foto,
                            'id_desa' => $request->desa
                        ]));
                        $user->update(array_merge($request->only('name','email'),[
                            'id_retailer' => $retailer->id
                        ]));
                    }

                } else {
                    if ($request->desa == null) {
                        $retailer->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude')));
                        $user->update(array_merge($request->only('name','email'),[
                            'id_retailer' => $retailer->id
                        ]));
                    } else {
                        // dd($request->all());
                        $retailer->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                            'id_desa' => $request->desa
                        ]));
                        $user->update(array_merge($request->only('name','email'),[
                            'id_retailer' => $retailer->id
                        ]));
                    }
                }
                return redirect('v1/account')->with('success',  __('Update Data Berhasil.'));
            }
        }
    }
    public function updateAkunKelompok(Request $request, $id)
    {
        if (Auth::user()->id_kelompok != null) {
            $v = Validator::make($request->all(),[
                'name' => 'required|string|max:50',
                'email' => 'required|unique:users,email,'.$id,
                'desa' => 'nullable',
                'kecamatan' => 'nullable',
                'kabupaten' => 'nullable',
                'provinsi' => 'nullable',
                'nama' => 'required|string|max:100',
                'ketua' => 'required|string|max:100',
                'kontak' => 'required|numeric',
                'alamat' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'foto_ketua' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if ($v->fails()) {
            // dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        }
        $auth = Auth::user();
        $user = User::find($id);
        if ($auth->id_kelompok != null) {
            $kelompok = KelompokTani::where('id',$auth->id_kelompok)->first();

            if ($request->file('foto_ketua') != '') {
                $name = $request->file('foto_ketua');
                $foto_ketua = time()."_".$name->getClientOriginalName();
                $request->foto_ketua->move(public_path("upload/foto/kelompok"), $foto_ketua);
                if ($request->desa == null) {
                    $kelompok->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                        'foto_ketua' => 'upload/foto/kelompok/'.$foto_ketua
                    ]));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_kelompok' => $kelompok->id
                    ]));
                } else {
                    $kelompok->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                        'foto_ketua' => 'upload/foto/kelompok/'.$foto_ketua,
                        'id_desa' => $request->desa
                    ]));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_kelompok' => $kelompok->id
                    ]));
                }

            } else {
                if ($request->desa == null) {
                    $kelompok->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude')));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_kelompok' => $kelompok->id
                    ]));
                } else {
                    // dd($request->all());
                    $kelompok->update(array_merge($request->only('nama','jenis_usaha','kontak','alamat','latitude','longitude'),[
                        'id_desa' => $request->desa
                    ]));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_kelompok' => $kelompok->id
                    ]));
                }
            }
            return redirect('v1/account')->with('success',  __('Update Data Berhasil.'));
        }
    }
    public function updateAkunEnduser(Request $request, $id)
    {
        if (Auth::user()->id_enduser != null) {
            $v = Validator::make($request->all(),[
                'desa' => 'nullable',
                'kecamatan' => 'nullable',
                'kabupaten' => 'nullable',
                'provinsi' => 'nullable',
                'nama' => 'required|string|max:100',
                'tgl_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'kontak' => 'required|numeric',
                'alamat' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        if ($v->fails()) {
            // dd($v->errors()->all());
            return back()->withErrors($v)->withInput();
        }
        $auth = Auth::user();
        $user = User::find($id);
        if ($auth->id_enduser != null) {
            $enduser = Enduser::where('id',$auth->id_enduser)->first();

            if ($request->file('foto') != '') {
                $name = $request->file('foto');
                $foto = time()."_".$name->getClientOriginalName();
                $request->foto->move(public_path("upload/foto/enduser"), $foto);
                if ($request->desa == null) {
                    $enduser->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                        'foto' => 'upload/foto/enduser/'.$foto
                    ]));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_enduser' => $enduser->id
                    ]));
                } else {
                    $enduser->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                        'foto' => 'upload/foto/enduser/'.$foto,
                        'id_desa' => $request->desa
                    ]));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_enduser' => $enduser->id
                    ]));
                }

            } else {
                if ($request->desa == null) {
                    $enduser->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude')));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_enduser' => $enduser->id
                    ]));
                } else {
                    // dd($request->all());
                    $enduser->update(array_merge($request->only('nama','jenis_kelamin','tgl_lahir','kontak','alamat','latitude','longitude'),[
                        'id_desa' => $request->desa
                    ]));
                    $user->update(array_merge($request->only('name','email'),[
                        'id_enduser' => $enduser->id
                    ]));
                }
            }
            return redirect('v1/account')->with('success',  __('Update Data Berhasil.'));
        }
    }
    public function updatePassword()
    {
        $data = User::find(Auth::user()->id);
        return view('app.account.updatePassword',compact('data'));
    }
    public function actionUpdatePassword(Request $request,$id)
    {
        $user = User::findOrFail($id);
        if (Hash::check($request->old_password, $user->password)) {
            $v = Validator::make($request->all(),[
                'old_password' => 'required',
                'new_password' => 'required|confirmed|min:6',
                'new_password_confirmation' => 'required'
            ],[
                'old_password.required' => 'Password Lama Harus diisi !',
                'new_password.required' => 'Password Baru Harus diisi !',
                'new_password_confirmation.required'=> 'Password Baru Harus dikonfirmasi !',
                'new_password.min' => 'Password Minimal 6 Karakter',
                'new_password_confirmation.confirmed' => 'Konfirmasi Password Baru tidak sesuai'
            ]);

            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }
            $user = User::find($id)->update(['password' => Hash::make($request->new_password)]);

            return redirect('v1/account')->with('success',  __('Update Data Password Berhasil.'));
        } else {
            $v = Validator::make($request->all(),[
                'old_password' => 'required',
            ],[
                'old_password.required' => 'Password Lama Harus diisi !',
            ]);
            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }

            return redirect('v1/account')->with('success',  __('Update Data Password Berhasil.'));
        }
    }
}
