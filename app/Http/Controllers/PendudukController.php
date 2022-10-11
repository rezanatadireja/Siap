<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pengaduan;
use App\Models\JenisPengaduan;
use App\Models\District;
use App\Models\JenisSyarat;
use App\Models\Regency;
use App\Models\SubBidang;
use App\Models\User;
use App\Models\Village;
use App\Notifications\KirimPengaduanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use DataTables;


class PendudukController extends Controller
{
    public function getJenisPelayanan()
    {
        $sub_bidang_id            = request()->get('sub_bidang_id');
        $jenisPengaduan           = JenisPengaduan::where('sub_bidang_id', $sub_bidang_id)->get();
        // dd($jenisPengaduan);
        return response()->json($jenisPengaduan);
    }

    public function getSyaratJenis()
    {
        $jenis_pengaduan_id        = request()->get('jenis_pengaduan_id');
        $jenisSyarat               = JenisSyarat::where('jenis_pengaduan_id', $jenis_pengaduan_id)->get();
        // dd($jenisPengaduan);
        return response()->json($jenisSyarat);
    }

    public function regencies()
    {
        // Method Kota/Kabupaten
        $provinces_id = request()->get('province_id');
        $regencies = Regency::where('province_id', '=', $provinces_id)->get();
        return response()->json($regencies);
    }

    public function districts()
    {
        // Method Kecamatan/Distrik
        $regencies_id = request()->get('regencies_id');
        $districts = District::where('regency_id', '=', $regencies_id)->get();
        return response()->json($districts);
    }

    public function villages()
    {
        // Method Desa/Kelurahan
        $districts_id = request()->get('districts_id');
        $villages = \Indonesia::findDistrict($districts_id, ['villages']);
        $desa = $villages->villages;

        return response()->json($desa);
    }

    public function index(Request $request)
    {
        // $penduduks = Penduduk::all();
        // $kecamatan = District::all();
        $kecamatan = \Indonesia::findCity(170, ['districts.villages']);
        if ($request->ajax()) {
            $data = Penduduk::with('user')->get();
            return Datatables::of($data)
                ->addColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->addColumn('nik', function ($data) {
                    return $data->nik;
                })
                ->addColumn('no_kk', function ($data) {
                    return $data->no_kk;
                })
                ->addColumn('email', function ($data) {
                    return $data->user->email;
                })
                ->addColumn('no_hp', function ($data) {
                    return $data->no_hp;
                })
                ->addColumn('aksi', function ($data) {
                    $button = "<a class='btn btn-primary btn-sm btn-edit text-white' data-id='" . $data->id . "' data-toggle='tooltip' title='' data-original-title='Lihat Pengaduan'><i class='fas fa-pencil-alt'></i></a>";
                    $button .= "<a class='ml-1 btn btn-danger btn-sm deleteBtn text-white' data-id='" . $data->id . "' data-toggle='tooltip' title='' data-original-title='Hapus Syarat'><i class='fas fa-trash'></i></a>";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->smart(true)
                ->make(true);
        }
        return view('admin.penduduk.index', ['kecamatan' => $kecamatan]);
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'nik' => 'required',
                'no_kk' => 'required',
                'no_hp' => 'required',
            ]
        );

        $warga = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $warga->assignRole('warga');

        $penduduk  = Penduduk::create([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'no_kk'         => $request->no_kk,
            'no_hp'         => '+' . 62 . $request->no_hp,
            'district_id'   => $request->kecamatan,
            'village_id'    => $request->desa,
            'user_id'       => $warga->id,
        ]);

        if ($penduduk) {
            return response()->json(['code' => 1, 'msg' => 'Data Penduduk Berhasil Disimpan.']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Data Penduduk Gagal Disimpan.']);
        }
    }

    public function pendudukPengaduan()
    {
        $id                         = Auth::user()->id;
        $data['penduduk']           = Penduduk::where('user_id', $id)->first();
        $data['sub_bidang']         = SubBidang::all();

        return view('guest.pengaduan', $data);
    }

    protected function nomorPengaduan()
    {
        $now = Carbon::now();
        $thnBln =  $now->year . $now->month . $now->day;
        $cek = Pengaduan::count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = 'PG' . $thnBln . $urut;
            // dd($nomer);
        } else {
            // echo "ada";
            $ambil = Pengaduan::all()->last();
            $urut = (int)substr($ambil->no_pengaduan, -5) + 1;
            $nomer = 'PG' . $thnBln . $urut;
        }

        return $nomer;
    }

    public function daftarPengaduan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pengaduan_id' => 'required',
        ], [
            'jenis_pengaduan_id.required' => 'Pastikan jenis pelayanan pengaduan sudah dipilih.'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 2, 'error' => $validator->messages()]);
        }

        $pelayanan = JenisPengaduan::where('id', $request->jenis_pengaduan_id)->get();
        $kuota = (int)$pelayanan->implode('kuota', ',');

        if ($kuota == 0) {
            return response()->json(['code' => 0]);
        } else {
            $pelayanan = JenisPengaduan::where('id', $request->jenis_pengaduan_id)->first();
            $pelayanan->kuota -= 1;
            $pelayanan->update();

            $pengaduan = new Pengaduan();
            $pengaduan->user_id             = $request->user_id;
            $pengaduan->jenis_pengaduan_id  = $request->jenis_pengaduan_id;
            $pengaduan->status              = 'baru';
            $pengaduan->detail              = 'baru';
            $pengaduan->no_pengaduan        = $this->nomorPengaduan();
            $pengaduan->save();

            $id = User::first();

            $data = [
                'user_id'           => $request->user_id,
                'name'              => $request->user_name,
                'jenis_pelayanan'   => $pengaduan->jenisPengaduan->nama,
                'status_pengaduan'  => $pengaduan->status
            ];

            Notification::send($id, new KirimPengaduanNotification($data));

            return response()->json(['code' => 1, 'id' => $pengaduan->id]);
        }
    }
    // $pelayanan = JenisPengaduan::where('id',$request->input('jenis_pelayanan'))->toArray();
    // $cek = (int)$pelayanan;


    public function destroy($id)
    {
        $data = Penduduk::where('id', $id)->first();
        $data->user()->delete();
        $data->delete();

        return back();
    }

    public function edit($id)
    {
        $penduduk = Penduduk::find($id);
        $kecamatan = \Indonesia::findCity(170, ['districts.villages']);

        if ($penduduk) {
            return response()->json([
                'code' => 1,
                'penduduk' => $penduduk,
                'username' => $penduduk->user->username,
                'kecamatan' => $kecamatan,
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Data Penduduk Tidak Ada.',
            ]);
        }
        // dd($kecamatan);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:4|max:30|confirmed',
            'nik' => 'required',
            'no_kk' => 'required',
            'no_hp' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'no_kk.required' => 'Nomor Kartu Keluarga tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $penduduk = Penduduk::find($id);
            $penduduk->nama = $request->input('nama');
            $penduduk->nik = $request->input('nik');
            $penduduk->no_kk = $request->input('no_kk');
            $penduduk->no_hp = $request->input('no_hp');
            $penduduk->district_id = $request->input('district_id');
            $penduduk->village_id = $request->input('village_id');
            $penduduk->update();
            sleep(4);
            // $user = User::find($penduduk->user_id);
            // $user->username = $request->input('username');
            // $user->email = $request->input('email');
            // if (!empty($request->input('password'))) {
            //     $user->password = Hash::make($request->input('password'));
            // }
            // $user->update();

            return response()->json(['status' => 200, 'msg' => 'Data Penduduk Berhasil Di Update.']);
        }
    }
}
