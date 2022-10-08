<?php

namespace App\Http\Controllers;

use App\Models\JenisPengaduan;
use App\Models\JenisSyarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;


class JenisSyaratController extends Controller
{
    public function index(Request $request)
    {
        $JenisPengaduan = JenisPengaduan::all();
        if ($request->ajax()) {
            $data = JenisSyarat::with('jenisPengaduan')->get();
            return Datatables::of($data)
                ->addColumn('bidang', function ($data) {
                    return $data->jenisPengaduan->subBidang->nama;
                })
                ->addColumn('layanan_pengaduan', function ($data) {
                    return $data->jenisPengaduan->nama;
                })
                ->addColumn('syarat_pengaduan', function ($data) {
                    return $data->nama;
                })
                ->addColumn('aksi', function ($data) {
                    $button = "<a class='btn btn-primary btn-sm edit text-white' id='" . $data->id . "' data-toggle='tooltip' title='' data-original-title='Lihat Pengaduan'><i class='fas fa-pencil-alt'></i></a>";
                    $button .= "<a class='ml-1 btn btn-danger btn-sm deleteBtn text-white' data-id='" . $data->id . "' data-toggle='tooltip' title='' data-original-title='Hapus Syarat'><i class='fas fa-trash'></i></a>";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->smart(true)
                ->make(true);
        }
        return view('admin.jenisSyarat.index', ['jenisPengaduan' => $JenisPengaduan]);
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
        // if(Request()->ajax()){
        $validator = Validator::make($request->all(), [
            'nama'                  => 'required|unique:jenis_syarats',
            'jenis_pengaduan_id'    => 'required',
        ], [
            'nama.required'                 => 'Nama jenis syarat tidak boleh kosong.',
            'nama.unique'                   => 'Nama jenis syarat sudah ada.',
            'jenis_pengaduan_id.required'   => 'Jenis pengaduan tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'errors' => $validator->messages()]);
        } else {
            $data                       = new JenisSyarat;
            $data->nama                 = $request->input('nama');
            $data->jenis_pengaduan_id   = $request->input('jenis_pengaduan_id');
            $data->save();

            // JenisSyarat::create([
            //     'nama'                  => $request->input('nama'),
            //     'jenis_pengaduan_id'    => $request->input('jenis_pengaduan_id')
            // ]);
            return response()->json(['code' => 1, 'msg' => 'Jenis syarat pengaduan berhasil disimpan.']);
            // $save = $this->storeJenis($request->all());
            // if($save == ''){
            // }else{
            // return response()->json(['code' => 2, 'msg' => 'Jenis syarat pengaduan gagal disimpan.']);
            // }
        }
        // }
    }

    protected function storeJenis($request)
    {
        JenisSyarat::create([
            'nama'                  => $request->input('nama'),
            'jenis_pengaduan_id'    => $request->input('jenis_pengaduan_id')
        ]);

        return '';
    }

    public function show(JenisSyarat $JenisSyarat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisSyarat  $JenisSyarat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo "heloo";
        $data = JenisSyarat::find($id);

        return view('admin.jenisSyarat.form-ubah', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $JenisSyarat = JenisSyarat::find($id);

        $validator = Validator::make($request->all(), [
            'jenis_pengaduan_id' => 'required',
            'nama' => 'required|unique:jenis_syarats',
        ], [
            'nama' => 'Syarat Pelayanan Pengaduan Tidak Boleh Kosong.',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $JenisSyarat->update([
                'jenis_pengaduan_id' => $request->jenis_pengaduan_id,
                'nama'               => $request->nama,
            ]);
            return response()->json(['code' => 1, 'msg' => 'Syarat pelayana pengaduan berhasil diupdate.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisSyarat  $JenisSyarat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = JenisSyarat::find($request->id);
        // dd($data);
        $query = $data->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Syarat Pelayanan Pengaduan Berhasil dihapus.']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Kesalahan dalam jaringan!']);
        }
    }
}
