<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\JenisMangga;
use App\Models\Mangga;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use Auth;

class JenisManggaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($data);
        if($request->ajax()){
            $data = JenisMangga::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a href="/v1/jenisMangga/'.$data->id.'/edit" class="text-primary"><i class="fa fa-edit"></i></a>&nbsp;<a href="#" class="text-danger" onclick="sweet('.$data->id.')"><i class="fa fa-trash"></i></a>';
                })
                ->make(true);
        }
        // dd($count);

        return view('app.jenisMangga.index');
    }

    public function getByJenis(Request $request, $id)
    {
        $user_id = $request->user;
        $auth = User::find($user_id);
        if($auth->role == 'retailer'){
            $mangga = Mangga::where('id_jenis',$id)->get();
            $data = [];
            foreach ($mangga as $m) {
                // $data[] = $p;
                $postingan = Postingan::with('mangga.jenis')->where('id_kelompok','!=',null)->where('id_mangga',$m->id)->get();
                foreach ($postingan as $p) {
                    $data[] = $p;
                }
            }
            return response()->json([
                'status' => 'Success Loaded',
                'data' => $data
            ]);
        }elseif ($auth->role == 'enduser') {
            $mangga = Mangga::where('id_jenis',$id)->get();
            $data = [];
            foreach ($mangga as $m) {
                // $data[] = $p;
                $postingan = Postingan::with('mangga.jenis')->where('id_retailer','!=',null)->where('id_mangga',$m->id)->get();
                foreach ($postingan as $p) {
                    $data[] = $p;
                }
            }
            return response()->json([
                'status' => 'Success Loaded',
                'data' => $data
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.jenisMangga.create');
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
            'nama' => 'required|string|max:100'
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            JenisMangga::create($request->all());
            return redirect('v1/jenisMangga')->with('success',__('Create Data Berhasil.'));
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
        $data = JenisMangga::find($id);
        return view('app.jenisMangga.edit',compact('data'));
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
            'nama' => 'required|string|max:100'
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            $jenisMangga = JenisMangga::find($id);
            $jenisMangga->update($request->all());
        }
        return redirect('v1/jenisMangga')->with('success',__('Update Data Berhasil.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisMangga::find($id)->delete();

        return back()->with('success',__('Delete Data Berhasil.'));
    }
}
