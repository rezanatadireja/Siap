<?php

namespace App\Http\Controllers;

use App\Models\JenisPengaduan;
use App\Models\JenisSyarat;
use App\Models\Syarat;
use App\Models\Penduduk;
use App\Models\Pengaduan;
use App\Models\User;
use App\Notifications\PengaduanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\MessageTrait;
use App\Http\Traits\WhatsappTrait;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;


class PengaduanController extends Controller
{
    use MessageTrait, WhatsappTrait;

    protected function cekSyarat($id)
    {
        $p = Pengaduan::where('id', $id)->pluck('jenis_pengaduan_id');
        $cek = JenisPengaduan::with('jenisSyarat')
            ->where('id', $p)
            ->withCount('jenisSyarat')
            ->get();
        return $cek;
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);
        if (request()->ajax()) {
            $syarat    = Syarat::where('pengaduan_id', $id)->orderBy('id', 'ASC')->get(); //DisiniQueryna
            $cek = $this->cekSyarat($id);
            $data = View::make('guest.listSyarat')->with(['syarat' => $syarat, 'cek' => $cek])->render();
            return response()->json(['code' => 1, 'result' => $data, 'cek' => $cek]);
        }
        return view('guest.pengaduanSyarat', ['pengaduan' => $pengaduan]);
    }

    public function simpanSyarat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image',
            'jenis_syarat_id' => 'required',
        ], [
            'file.required' => 'Silahkan pilih file yang akan di upload',
            'file.image'    => 'Ekstensi file harus Jpg, Jpeg, Png',
            'jenis_syarat_id.required' => 'Pilihan syarat harus dipilih.',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $path = 'files/';
            $file = $request->file('file');
            $file_name = time() . '_' . $file->getClientOriginalName();

            $upload = $file->storeAs($path, $file_name, 'public');
            if ($upload) {
                Syarat::where('jenis_syarat_id', $request->jenis_syarat_id)
                    ->where('pengaduan_id', $request->pengaduan_id)->delete();
                Syarat::create([
                    'jenis_syarat_id' => $request->jenis_syarat_id,
                    'pengaduan_id'    => $request->pengaduan_id,
                    'file'            => $file_name,
                    'status'          => 'baru',
                ]);
                return response()->json(['code' => 1, 'msg' => 'Berkas Syarat Berhasil Disimpan.']);
            }
        };
    }

    public function getSyarat($id)
    {
        $syarat = Syarat::find($id);
        return response()->json(['code' => 1, 'result' => $syarat]);
        // dd($request);
    }

    public function getPengaduan($id)
    {
        $pengaduan = Pengaduan::find($id);
        return response()->json(['code' => 1, 'result' => $pengaduan]);
        // dd($request);
    }

    public function updateSyarat(Request $request)
    {
        $syarat_id = $request->syarat_id;
        $syarat = Syarat::find($syarat_id);
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

    public function deleteSyarat(Request $request)
    {
        $syarat = Syarat::find($request->syarat_id);
        $path = 'files/';
        $image_path = $path . $syarat->file;
        if ($syarat->file != null && Storage::disk('public')->exists($image_path)) {
            Storage::disk('public')->delete($image_path);
        }

        $query = $syarat->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Syarat Pengaduan Berhasil dihapus.']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Kesalahan dalam jaringan!']);
        }
    }

    public function adminIndex()
    {
        return view('admin.pengaduan.index');
    }

    public function daftarPengaduan(Request $request)
    {
        $data = Pengaduan::with('user', 'jenisPengaduan')
            ->whereIn('status', ['baru', 'diperbaiki'])
            ->orderBy('created_at', 'ASC')
            ->get();

        if ($request->ajax()) {
            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $data = Pengaduan::whereDate('created_at', $request->from_date)->latest();
                } else {
                    $data = Pengaduan::whereBetween('created_at', array($request->from_date, $request->to_date))->latest();
                }
            }
            return DataTables::of($data)
                ->filter(function ($instance) use ($request) {
                    if ($request->has('status') && $request->status != null) {
                        return $instance->where('status', $request->status);
                    }
                })
                ->addColumn('user_name', function ($data) {
                    return $data->user->penduduk->nama;
                })
                ->addColumn('nik', function ($data) {
                    return $data->user->penduduk->nik;
                })
                ->addColumn('jenis_pengaduan', function ($data) {
                    return $data->jenisPengaduan->nama;
                })
                ->addColumn('jenis_bidang', function ($data) {
                    return $data->jenisPengaduan->subBidang->nama;
                })
                ->editColumn('created_at', function ($data) {
                    return [
                        'display' => e($data->created_at->format('d/m/Y')),
                        'timestamp' => $data->created_at->timestamp
                    ];
                })
                ->addColumn('aksi', function ($data) {
                    $button = "<a class='btn btn-primary btn-sm btn-edit text-white' id='" . $data->id . "' data-toggle='tooltip' title='' href='pengaduan/" . $data->id . "' data-original-title='Lihat Pengaduan'><i class='fas fa-pencil-alt'></i></a>";
                    return $button;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 'baru') {
                        return '<div class="badge badge-warning"><i class="fab fa-font-awesome-flag"></i> Baru</div>';
                    } elseif ($data->status == 'diterima') {
                        return '<div class="badge badge-success"><i class="fas fa-check-circle"></i> Diterima</div>';
                    }
                })
                ->rawColumns(['aksi', 'status', 'pengaduan'])
                ->make(true);
        }
    }

    public function detailSyarat($id)
    {
        $pengaduan = Pengaduan::find($id);
        if (request()->ajax()) {
            $syarat    = Syarat::where('pengaduan_id', $id)->orderBy('id', 'DESC')->get();
            $cek = $this->cekSyarat($id);
            $data      = View::make('admin.pengaduan.daftarSyarat')->with(['syarat' => $syarat, 'cek' => $cek])->render();
            return response()->json(['code' => 1, 'result' => $data, 'cek' => $cek]);
        }
        return view('admin.pengaduan.syarat', ['pengaduan' => $pengaduan]);
    }

    public function lihatSyarat($id)
    {
        $syarat = Syarat::find($id);
        return view('admin.pengaduan.lihatSyarat', ['syarat' => $syarat]);
    }

    public function lihatPesan($id)
    {
        $pengaduan = Pengaduan::find($id);

        return view('admin.pengaduan.lihatPesan', ['pengaduan' => $pengaduan]);
    }

    public function konfirmasitSyarat(Request $request)
    {
        $syarat = Syarat::find($request->syarat_id);
        $syarat->keterangan = strip_tags($request->keterangan);
        $syarat->status = $request->status;
        $syarat->save();

        if ($syarat) {
            return response()->json(['code' => 1, 'msg' => 'Syarat pelayanan pengaduan berhasil dikonfirmasi.']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Kesalahan dalam jaringan!']);
        }
    }

    public function updateStatusPengaduan($id)
    {
        $syarat = Syarat::where('pengaduan_id', $id)
            ->whereIn('status', ['baru', 'diperbaiki']);

        if ($syarat->exists()) {
            return response()->json(['code' => 0, 'msg' => 'Pastikan syarat sudah dikonfirmasi semua!']);
        } else {
            $pengaduan = Pengaduan::find($id);
            $pengaduan->status = 'diterima';
            $pengaduan->save();

            $pengaduanData = [
                'subject' => 'Pengaduan ' . $pengaduan->jenisPengaduan->nama,
                'body' => 'Pengaduan ' . $pengaduan->jenisPengaduan->nama . ' atas nama ' . $pengaduan->user->penduduk->nama .
                    ' telah di verifikasi silahkan login untuk dapat mengunduh berkas :',
                'action' => 'Klik Disini!',
                'url'   => url('/'),
                'thank you' => 'Terima Kasih, mohon maaf bila ada kesalahan.',
                'user_id' => $pengaduan->user_id,
                'jenis_pelayanan' => $pengaduan->jenisPengaduan->nama,
                'user_name' => $pengaduan->user->penduduk->nama,
                'status_pengaduan' => $pengaduan->status
            ];

            $users = $pengaduan->pluck('user_id');
            $user = User::whereIn('id', $users)->get();
            Notification::send($user, new PengaduanNotification($pengaduanData));

            return response()->json(['code' => 1, 'msg' => 'Pengaduan sudah dikonfirmasi.']);
        }
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back();
    }

    public function read($id)
    {
        // dd($id);
        // $data = User::find($id);
    }

    public function mYpengaduan()
    {
        $id = Auth::user()->id;
        $penduduk = Penduduk::find($id);
        if (request()->ajax()) {
            $pengaduan = Pengaduan::where('user_id', $id)->orderBy('id', 'DESC')->get();
            $data      = View::make('guest.pengaduanSaya')->with(['pengaduan' => $pengaduan])->render();
            return response()->json(['code' => 1, 'result' => $data]);
        }
        return view('guest.mYpengaduan', ['penduduk' => $penduduk]);
    }

    public function showPengaduan($id)
    {
        $pengaduan = Pengaduan::find($id);
        if (request()->ajax()) {
            $syarat    = Syarat::where('pengaduan_id', $id)->orderBy('id', 'DESC')->get();
            $cek = $this->cekSyarat($id);
            $data      = View::make('guest.riwayat.list-syarat')->with(['syarat' => $syarat, 'cek' => $cek])->render();
            return response()->json(['code' => 1, 'result' => $data, 'cek' => $cek]);
        }
        return view('guest.riwayat.index', ['pengaduan' => $pengaduan]);
    }

    public function showSyaratMy($id)
    {
        $syarat = Syarat::find($id);
        return response()->json([
            'code' => 1,
            'result' => $syarat,
            'nama' => $syarat->jenisSyarat->nama,
            'file' => $syarat->file,
        ]);
    }

    public function notifyWhatsApp(Request $request)
    {
        if (Request()->ajax()) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'message' => 'required'
            ], [
                'message.required' => 'Isi pesan tidak boleh kosong.'
            ]);
            if ($validator->fails()) {
                return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                $kirim = $this->kirimWhatsapp($input);
                if ($kirim == '') {
                    return response()->json(['code' > 1, 'msg' => 'Pesan Whatsapp berhasil dikirim.']);
                } else {
                    return response()->json(['code' > 2, 'msg' => 'Pesan Whatsapp gagal dikirim.']);
                }
            }
        }
    }

    protected function kirimWhatsapp($input)
    {
        $twilio = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));
        $wa = getenv("TWILIO_WHATSAPP_FROM");
        $number = $input['no_hp'];

        $twilio->messages->create(
            "whatsapp:$number",
            [
                "from" => "whatsapp:$wa",
                'body' => $input['message']
            ]
        );

        return '';
    }
    // public function showSyarat($id)
    // {
    //     $syarat = Syarat::find($id);
    //     return response()->json([
    //         'code' => 1, 
    //         'result' => $syarat,
    //         'nama' => $syarat->jenisSyarat->nama,
    //         'file' => $syarat->file,
    //     ]);
    // }

    // public function kirimSMS(Request $request)
    // {
    //     if (Request()->ajax()) {
    //         $input = $request->all();
    //         $validator = Validator::make($input, [
    //             'message' => 'required'
    //         ], [
    //             'message.required' => 'Pesan SMS tidak boleh kosong.'
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    //         } else {
    //             $kirim = $this->kirimSMSPemberitahuan($input);
    //             if ($kirim == '') {
    //                 return response()->json(['code' => 1, 'msg' => 'Pesan Berhasil Dikirim.']);
    //             } else {
    //                 return response()->json(['code' => 2, 'msg' => 'Pesan Gagal Dikirim.']);
    //             }
    //         }
    //     }
    // }

    // protected function kirimSMSPemberitahuan($input)
    // {
    //     $client = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));
    //     $number = $input['no_hp'];

    //         $client->messages->create(
    //             $number,
    //             [
    //                 'from' => getenv("TWILIO_NUMBER"),
    //                 // 'body' => $request->pesan
    //                 'body' => $input['message']
    //             ]
    //         );

    //     return '';
    // }
}
