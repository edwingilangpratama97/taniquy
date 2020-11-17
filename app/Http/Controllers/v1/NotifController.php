<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifController extends Controller
{
    public function getNotif()
    {
        $data = Notification::with('pemesanan','penawaran')->orderBy('waktu','desc')->limit(4)->get();

        return response()->json([
            'data' => $data,
            'status' => true,
            'message' => 'add all Data'
        ]);
    }
    public function clickNotif()
    {
        $data = Notification::where('status','=','0')->get();
        // dd($data);

        foreach ($data as $key => $value) {
            Notification::find($value->id)->update(['status'=>'1']);
        }

    }
    public function getStatus()
    {
        $data = Notification::where('status','=','0')->get();
        // dd($data);
        return response()->json([
            'data' => $data,
            'status' => true,
            'message' => 'add all Data'
        ]);
    }
}
