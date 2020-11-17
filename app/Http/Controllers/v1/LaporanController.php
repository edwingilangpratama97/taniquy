<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Penawaran;
use App\Models\Postingan;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function pemesanan()
    {
        return view('app.laporan.pemesanan.index');
    }
    public function PdfPemesanan(Request $request)
    {
        // dd($request->all());
        set_time_limit(99999);
        $this->validate($request,[
            'awal' => 'required|date',
            'akhir' => 'required|date'
        ]);

        $awal = $request->awal;
        $akhir = $request->akhir;

        if ($awal > $akhir) {
             return back()->with('failed','Tanggal Awal Dilarang Melampaui Tanggal Akhir');
        }
        if ($request->role == 'enduser') {
            $data = Pemesanan::whereBetween('created_at',[$request->awal, $request->akhir])->where('id_enduser','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role End User";

            $pdf = PDF::loadview('app.laporan.pemesanan.pemesanan_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Pemesanan'.$request->akhir.'.pdf');
            return view('app.laporan.pemesanan.pemesanan_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }elseif ($request->role == 'retailer') {
            $data = Pemesanan::whereBetween('created_at',[$request->awal, $request->akhir])->where('id_retailer','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role Retailer";

            $pdf = PDF::loadview('app.laporan.pemesanan.pemesanan_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Pemesanan'.$request->akhir.'.pdf');
            return view('app.laporan.pemesanan.pemesanan_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }
    }
    public function penawaran()
    {
        return view('app.laporan.penawaran.index');
    }
    public function pdfPenawaran(Request $request)
    {
        set_time_limit(99999);
        $this->validate($request,[
            'awal' => 'required|date',
            'akhir' => 'required|date'
        ]);

        $awal = $request->awal;
        $akhir = $request->akhir;

        if ($awal > $akhir) {
             return back()->with('failed','Tanggal Awal Dilarang Melampaui Tanggal Akhir');
        }
        if ($request->role == 'kelompok') {
            $data = Penawaran::with('mangga.jenis')->whereBetween('created_at',[$request->awal, $request->akhir])->where('id_kelompok','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role Kelompok Tani";

            $pdf = PDF::loadview('app.laporan.penawaran.penawaran_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Penawaran'.$request->akhir.'.pdf');
            return view('app.laporan.penawaran.penawaran_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }elseif ($request->role == 'retailer') {
            $data = Penawaran::whereBetween('created_at',[$request->awal, $request->akhir])->where('id_retailer','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role Retailer";

            $pdf = PDF::loadview('app.laporan.penawaran.penawaran_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Penawaran'.$request->akhir.'.pdf');
            return view('app.laporan.penawaran.penawaran_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }
    }
    public function postingan()
    {
        return view('app.laporan.postingan.index');
    }
    public function pdfPostingan(Request $request)
    {
        set_time_limit(99999);
        $this->validate($request,[
            'awal' => 'required|date',
            'akhir' => 'required|date'
        ]);

        $awal = $request->awal;
        $akhir = $request->akhir;

        if ($awal > $akhir) {
             return back()->with('failed','Tanggal Awal Dilarang Melampaui Tanggal Akhir');
        }
        if ($request->role == 'kelompok') {
            $data = Postingan::with('mangga.jenis')->whereBetween('created_at',[$request->awal, $request->akhir])->where('id_kelompok','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role Kelompok Tani";

            $pdf = PDF::loadview('app.laporan.postingan.postingan_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Postingan'.$request->akhir.'.pdf');
            return view('app.laporan.postingan.postingan_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }elseif ($request->role == 'retailer') {
            $data = Postingan::whereBetween('created_at',[$request->awal, $request->akhir])->where('id_retailer','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role Retailer";

            $pdf = PDF::loadview('app.laporan.postingan.postingan_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Postingan'.$request->akhir.'.pdf');
            return view('app.laporan.postingan.postingan_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }
    }
    public function kebutuhan()
    {
        return view('app.laporan.kebutuhan.index');
    }
    public function PdfKebutuhan(Request $request)
    {
        // dd($request->all());
        set_time_limit(99999);
        $this->validate($request,[
            'awal' => 'required|date',
            'akhir' => 'required|date'
        ]);

        $awal = $request->awal;
        $akhir = $request->akhir;

        if ($awal > $akhir) {
             return back()->with('failed','Tanggal Awal Dilarang Melampaui Tanggal Akhir');
        }
        if ($request->role == 'enduser') {
            $data = Pemesanan::whereBetween('created_at',[$request->awal, $request->akhir])->where('id_enduser','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role End User";

            $pdf = PDF::loadview('app.laporan.kebutuhan.kebutuhan_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Kebutuhan'.$request->akhir.'.pdf');
            return view('app.laporan.kebutuhan.kebutuhan_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }elseif ($request->role == 'retailer') {
            $data = Pemesanan::whereBetween('created_at',[$request->awal, $request->akhir])->where('id_retailer','!=',null)->latest()->get();
            if(count($data) == 0){
                return back()->with('failed', "Tidak ada data dari ".$request->awal." sampai ".$request->akhir);
            }
            $pos = 'role';
            $sumber = "Role Retailer";

            $pdf = PDF::loadview('app.laporan.kebutuhan.kebutuhan_pdf',compact('data','pos','awal','akhir','sumber'));
            set_time_limit(300);
            return $pdf->stream('Kebutuhan'.$request->akhir.'.pdf');
            return view('app.laporan.kebutuhan.kebutuhan_pdf',compact('data','pos','awal','akhir','sumber'));
            if ($data->isEmpty()) {
                return back()->with('failed','Data Kosong !');
            }
        }
    }
}
