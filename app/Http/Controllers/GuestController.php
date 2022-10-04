<?php

namespace App\Http\Controllers;

use App\Models\JenisPengaduan;
use App\Models\Penduduk;
use App\Models\Pengaduan;
use App\Models\Syarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class GuestController extends Controller
{
    public function info() 
    {
        $jenisPengaduan = JenisPengaduan::with('jenisSyarat', 'bidangPengaduan', 'subBidang')->get();
        // $subBidang = $jenisPengaduan->bidangPengaduan()->subBidang();
        // $jenisPengaduan = JenisPengaduan::all();

        return view('guest.info.index', ['jenisPengaduan' => $jenisPengaduan]);
    }

    public function cekPengaduan()
    {
        return view('guest.cek_pengaduan.index');
    }

    public function cekPengaduanStatus(Request $request)
    {
        // dd($request->all());
        if(request()->ajax()){
            $input = $request->all();
            $validator = Validator::make($input, [
                'no_pengaduan'   => 'required',
                'nik'            => 'required', 
            ],[
                'no_pengaduan.required' => 'Nomor Pengaduan Tidak Boleh Kosong',
                'nik.required'          => 'Nomor Induk Kependudukan Tidak Boleh Kosong',
                // 'nik.max'            => 'Periksa Kembali Nomor Induk Kependudukan',
                // 'nik.min'            => 'Nomor Induk Kependudukan Kurang dari 16 Digit',
            ]);
            if($validator->fails()){
                return response()->json(['status' => 400, 'errors' => $validator->messages()]);
            }else{
                $nik = Penduduk::where('nik', $input['nik'])->first();
                if($nik != null){
                    $pengaduan = Pengaduan::with('jenisPengaduan')->where('no_pengaduan', $input['no_pengaduan'])->first();
                    $syarat = Syarat::with('jenisSyarat')->where('pengaduan_id', $pengaduan->id)->get();
                    // $data = View::make('guest.cek_pengaduan.list-syarat')->with('syarat', $syarat)->render();
                    return response()->json([
                        'status'            => 200,
                        // 'result'            => $data,
                        'syarat'            => $syarat,
                        'pengaduan'         => $pengaduan,
                        'status_pengaduan'  => $pengaduan->status,
                        'jenis_pengaduan'   => $pengaduan->jenisPengaduan->nama,
                        'bag_bidang'        => $pengaduan->jenisPengaduan->bidangPengaduan->name,
                        'sub_bidang'        => $pengaduan->jenisPengaduan->subBidang->nama,
                        'user_name'         => $pengaduan->user->penduduk->nama,
                        'user_nik'          => $pengaduan->user->penduduk->nik,
                    ]);
                }else{
                    return response()->json(['status' => 404, 'msg' => 'Periksa Kembali Nomor Induk Kependudukan.']);
                }
            }
        }
    }
}
