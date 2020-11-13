<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1','namespace'=>'v1'], function(){
	Route::get('getKabupaten/{id}','KabupatenController@getKabupaten');
	Route::get('getKecamatan/{id}','KecamatanController@getKecamatan');
	Route::get('getDesa/{id}','DesaController@getDesa');
	Route::get('getKelompok/{id}','KelompokTaniController@show');
	Route::get('getEnduser/{id}','EnduserController@show');
	Route::get('getRetailer/{id}','RetailerController@show');
	Route::get('getMangga/{id}','ManggaController@show');
	Route::get('getPostingan/{id}','PostinganController@show');
	Route::get('getPemesanan/{id}','PemesananController@show');
	Route::get('getPenawaran/{id}','PenawaranController@show');
});
