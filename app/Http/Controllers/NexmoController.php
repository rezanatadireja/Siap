<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;   

class NexmoController extends Controller
{
    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     // $nexmo = app('Nexmo\Client');
    //     $nexmo->message()->send([
    //         'to' => $request->no_hp,
    //         'from' => 'Hilmi Purdimen',
    //         'text' => $request->pesan,
    //     ]);

    //     if($nexmo){
    //         return response()->json(['code' => 1, 'msg' => 'Pesan Berhasil Di Kirim.']);
    //     } else {
    //         return response()->json(['code' => 0, 'msg' => 'Kesalahan dalam jaringan, silahkan cek persyaratan kembali!']);
    //     }
    // }

    // public function index()
    // {
    //     return view('nexmo');
    // }

    public function store(Request $request)
    {
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => $request->no_hp,
            'from' => 'Hilmi Purdimen',
            'text' => $request->pesan,
        ]);

        return back();
        // dd($request->all());
    }
}
