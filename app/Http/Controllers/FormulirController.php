<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Syarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FormulirController extends Controller
{
    public function index()
    {
        $data = Formulir::all();
        // dd($data);
        return view('admin.formulir.index', ['data' => $data]);
    }

    public function uploadBerkas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlsx,xls,pdf|max:2048',
        ], [
            'file.required' => 'Silahkan pilih file yang akan di upload',
            'file.mimes'    => 'Ekstensi file harus jpg,jpeg,csv,txt,xlx,xls,pdf,docx',
            'file.max'    => 'File Minimal Berukuran 2Mb',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $path = 'files/formulir';
            $file = $request->file('file');
            // $extension = $file->getClientOriginalExtension();
            $namafile = $file->getClientOriginalName();
            $file_name = date('YmdHis') . '_' . $namafile;

            $upload = $file->storeAs($path, $file_name, 'public');
            if ($upload) {
                Formulir::create([
                    'name' => $request->name,
                    'file' => $file_name,
                ]);
                return response()->json(['code' => 1, 'msg' => 'Data Berhasil Disimpan.']);
            }
        };
    }

    public function download(Request $request, $file)
    {
        return response()->download(public_path('files/formulir/'. $file));
    }

    public function formulirGuest(Request $request)
    {
        if ($request->ajax()) {
            $data = Formulir::all();
            return Datatables::of($data)
                ->addColumn('name', function ($data) {
                        return $data->name;
                })
                ->addColumn('file', function ($data) {
                    $download = "<a href='".url('storage/files/formulir', $data->file)."' class='btn btn-icon icon-left btn-primary' target='_blank'><i class='fa fa-download'></i> Download</a>";
                    return $download;
                })
                // ->addColumn('aksi', function ($data) {
                //     $button = "<a class='btn btn-primary btn-sm btn-edit text-white' id='" . $data->id . "' data-toggle='tooltip' title='' href='pengaduan/" . $data->id . "' data-original-title='Lihat Pengaduan'><i class='fas fa-pencil-alt'></i></a>";
                //     return $button;
                // })
                ->rawColumns(['aksi', 'file'])
                ->smart(true)
                ->make(true);
            }

        return view('guest.formulir.index');
    }

    public function updateFormulir(Request $request)
    {
        $formulir_id = $request->formulir_id;
        $syarat = Syarat::find($formulir_id);
        $path = 'files/';

        $validator = Validator::make($request->all(), [
            'jenis_syarat_id' => 'required',
            'file_update' => 'image',
        ], [
            'file_update' => 'File harus berupa gambar format: JPG, JPEG, PNG',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($request->hasFile('file_update')) {
                $file_path = $path . $syarat->file;
                //Delete Old Syarat
                if ($syarat->file != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                //upload Syarat File
                $file = $request->file('file_update');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $upload = $file->storeAs($path, $file_name, 'public');

                if ($upload) {
                    $syarat->update([
                        'pengaduan_id'    => $request->pengaduan_id,
                        'jenis_syarat_id' => $request->jenis_syarat_id,
                        'file'            => $file_name,
                        'status'          => 'baru',
                        'keterangan'      => '',
                    ]);
                    return response()->json(['code' => 1, 'msg' => 'Data Persyaratan Pengaduan berhasil diupdate.']);
                }
            } else {
                Syarat::where('jenis_syarat_id', $request->jenis_syarat_id)
                    ->where('pengaduan_id', $request->pengaduan_id)->delete();
                $syarat->update([
                    'pengaduan_id'    => $request->pengaduan_id,
                    'jenis_syarat_id' => $request->jenis_syarat_id,
                ]);
                return response()->json(['code' => 1, 'msg' => 'Syarat Berhasil Diupdate.']);
            }
        }
    }

    public function editFormulir($id)
    {
        $formulir = Formulir::find($id);

        return view('admin.formulir.edit', ['formulir' => $formulir]);
    }

    public function deleteFormulir(Request $request)
    {
        $formulir = Formulir::find($request->id);
        $path = 'files/';
        $image_path = $path . $formulir->file;
        if ($formulir->file != null && Storage::disk('public')->exists($image_path)) {
            Storage::disk('public')->delete($image_path);
        }

        $query = $formulir->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Syarat Pengaduan Berhasil dihapus.']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Kesalahan dalam jaringan!']);
        }
    }
}