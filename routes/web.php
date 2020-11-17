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
<<<<<<< HEAD
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
    Route::get('notif','NotifController@notif')->name('notif');
    Route::post('clickNotif','NotifController@clickNotif')->name('clickNotifikasi');

	Route::resource('kelompok','KelompokTaniController');
	Route::resource('retailer','RetailerController');
	Route::resource('customer','EndUserController');
	Route::resource('mangga','ManggaController');
	Route::resource('jenisMangga','JenisManggaController');
	Route::resource('grade','GradeController');
=======
    Route::post('postKebutuhan','KebutuhanController@postKebutuhan')->name('postKebutuhan');
    Route::post('postMangga','PostinganController@postMangga')->name('postMangga');
    Route::put('completeAccount/{id}','DashboardController@completeAccount')->name('completeAccount')->middleware('admin');
    Route::get('account','AuthController@account')->name('account')->middleware('admin');
    Route::get('updateAkunRetailer','AuthController@updateAccountRetailer')->name('updateAkunRetailer')->middleware('admin');
    Route::get('updateAkunKelompok','AuthController@updateAccountKelompok')->name('updateAkunKelompok')->middleware('admin');
    Route::get('updateAkunEnduser','AuthController@updateAccountEnduser')->name('updateAkunEnduser')->middleware('admin');
    Route::get('updateAkunAdmin','AuthController@updateAccountAdmin')->name('updateAkunAdmin')->middleware('admin');
    Route::put('updateAccountRetailer/{id}','AuthController@updateAkunRetailer')->name('updateAccountRetailer')->middleware('admin');
    Route::put('updateAccountKelompok/{id}','AuthController@updateAkunKelompok')->name('updateAccountKelompok')->middleware('admin');
    Route::put('updateAccountEnduser/{id}','AuthController@updateAkunEnduser')->name('updateAccountEnduser')->middleware('admin');
    Route::put('updateAccountAdmin/{id}','AuthController@updateAkunAdmin')->name('updateAccountAdmin')->middleware('admin');
    Route::get('updatePassword','AuthController@updatePassword')->name('updatePassword')->middleware('admin');
    Route::put('updatePassword/{id}','AuthController@actionUpdatePassword')->name('actionUpdatePassword')->middleware('admin');
	Route::resource('kelompok','KelompokTaniController')->middleware('admin');
	Route::resource('retailer','RetailerController')->middleware('admin');
	Route::resource('customer','EndUserController')->middleware('admin');
	Route::resource('mangga','ManggaController')->middleware('admin');
	Route::resource('jenisMangga','JenisManggaController')->middleware('admin');
	Route::resource('grade','GradeController')->middleware('admin');
>>>>>>> 59cf8b2497b05b5faa582762b58d2da344f49d89
	Route::resource('postingan','PostinganController');
	Route::resource('pemesanan','PemesananController');
	Route::resource('kebutuhan','KebutuhanController');
	Route::resource('penawaran','PenawaranController');
	Route::resource('setApp','SetAppController')->middleware('admin');
});

