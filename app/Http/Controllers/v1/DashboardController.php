<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $auth = Auth::user();
        if ($auth->id_kelompok != null) {
            if($auth->kelompok->latitude == null || $auth->kelompok->longitude == null){
                echo "Anda Kelompok Tani Isi Dulu Kelengkapan Akun Anda";
            }
        }else if ($auth->id_retailer != null) {
            if($auth->retailer->latitude == null || $auth->kelompok->longitude == null){
                echo "Anda Retailer Tani Isi Dulu Kelengkapan Akun Anda";
            }
        } elseif ($auth->id_enduser != null) {
            if($auth->enduser->latitude == null || $auth->kelompok->longitude == null){
                echo "Anda Enduser Tani Isi Dulu Kelengkapan Akun Anda";
            }
        } else {
            // echo "Anda Sang Dewa";
            return view('app.dashboard');
        }
        // return view('app.dashboard');
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
