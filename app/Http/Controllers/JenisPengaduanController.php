<?php

namespace App\Http\Controllers;

use App\Models\BidangPengaduan;
use App\Models\SubBidang;
use App\Models\JenisPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JenisPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelayanan = JenisPengaduan::all();
        $b = BidangPengaduan::all();
        $s = SubBidang::all();

        return view('admin.jenisPengaduan.index', ['pelayanan' => $pelayanan, 'b' => $b, 's' => $s]);
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
        // dd($request->all());
        $request->validate([
            'nama' => 'required|unique:jenis_pengaduans|max:50',
        ]);

        $data = New JenisPengaduan();
        $data->nama                 = $request->nama;
        $data->bidang_pengaduan_id  = $request->bidang_pengaduan_id;
        $data->sub_bidang_id        = $request->sub_bidang_id;
        $data->kuota                = $request->kuota;
        $data->save();

        notify()->success("Data Berhasil Disimpan!", "Success", "topRight");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisPengaduan  $jenisPengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(JenisPengaduan $jenisPengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisPengaduan  $jenisPengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = JenisPengaduan::find($id);
        $b = BidangPengaduan::all();
        $s = SubBidang::all();
        
        if($data)
        {
            return response()->json([
                'code' => 1,
                'id' => $data->id,
                'nama' => $data->nama,
                'kuota' => $data->kuota,
                'bidang' => $data->bidang_pengaduan_id,
                'sub_bidang' => $data->sub_bidang_id,
                'b' => $b,
                's' => $s,
            ]);
        }else{
            return response()->json([
                'code' => 0,
                'msg' => 'Data Pelayanan Tidak Ada.',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisPengaduan  $jenisPengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax())
        {
            $input = $request->all();
            $validator = Validator::make($input, [
                'nama' => 'required',
                'kuota' => 'required',
            ]);
            
            if($validator->fails()){
                return response()->json(['status' => 400, 'errors' => $validator->messages()]);
            }else{
                $jenisPengaduan = JenisPengaduan::where('id', $input['id'])->first();

                if($jenisPengaduan != null){
                    $hasil = $this->updateJenis($input, $jenisPengaduan);
                    if($hasil == ''){
                        return response()->json(['status' => 200, 'msg' => 'Data Berhasil Diupdate.']);
                    }else{
                        return response()->json(['status' => 404, 'msg' => 'Data Gagal Diupdate.']);
                    }
                }
            }
        }
    }

    protected function updateJenis($input, $jenisPengaduan)
    {
        JenisPengaduan::where('id', $jenisPengaduan->id)->update([
            'nama'                  => $input['nama'],
            'kuota'                 => $input['kuota'],
            'bidang_pengaduan_id'   => $input['bidang_pengaduan_id'],
            'sub_bidang_id'         => $input['sub_bidang_id'],
        ]);
        return '';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisPengaduan  $jenisPengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = JenisPengaduan::find($id);
        $data->delete();

        notify()->success("Data Berhasil Dihapus.", "Success", "topRight");

        return back();
    }
}
