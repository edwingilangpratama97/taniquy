<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'v1','namespace'=>'v1','middleware'=>'auth'], function(){
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::get('account','AuthController@account')->name('account');
    Route::get('updateAkunRetailer','AuthController@updateAccountRetailer')->name('updateAkunRetailer');
    Route::get('updateAkunKelompok','AuthController@updateAccountKelompok')->name('updateAkunKelompok');
    Route::get('updateAkunEnduser','AuthController@updateAccountEnduser')->name('updateAkunEnduser');
    Route::get('updateAkunAdmin','AuthController@updateAccountAdmin')->name('updateAkunAdmin');
    Route::put('updateAccountRetailer/{id}','AuthController@updateAkunRetailer')->name('updateAccountRetailer');
    Route::put('updateAccountKelompok/{id}','AuthController@updateAkunKelompok')->name('updateAccountKelompok');
    Route::put('updateAccountEnduser/{id}','AuthController@updateAkunEnduser')->name('updateAccountEnduser');
    Route::put('updateAccountAdmin/{id}','AuthController@updateAkunAdmin')->name('updateAccountAdmin');
    Route::get('updatePassword','AuthController@updatePassword')->name('updatePassword');
    Route::put('updatePassword/{id}','AuthController@actionUpdatePassword')->name('actionUpdatePassword');

	Route::resource('kelompok','KelompokTaniController');
	Route::resource('retailer','RetailerController');
	Route::resource('customer','EndUserController');
	Route::resource('mangga','ManggaController');
	Route::resource('jenisMangga','JenisManggaController');
	Route::resource('grade','GradeController');
	Route::resource('postingan','PostinganController');
	Route::resource('pemesanan','PemesananController');
	Route::resource('kebutuhan','KebutuhanController');
	Route::resource('penawaran','PenawaranController');
});

