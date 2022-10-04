<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Pengaduan;
use App\Models\JenisPengaduan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request as FacadesRequest;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function landingPage()
    {
        return view('guest.index');
    }

    public function index(Request $request)
    {
        // if (Auth::user()->hasRole('admin')) return $this->adminDashboard();
        // if (Auth::user()->hasRole('warga')) return $this->wargaDashboard();

        // return view('guest.index');
        $user = $request->user();
        
        if ($user->hasRole('admin')) {
            return $this->adminDashboard($request);
        }

        return $this->wargaDashboard();
    }

    public function getJumlahPengaduan()
    {
        $pengaduans = Pengaduan::all();

        $dataPoints = [];

        foreach ($pengaduans as $pengaduan) {
            
            $dataPoints[] = array(
                "name" => $pengaduan->jenisPengaduan['nama'],
                "data" => [
                    intval($pengaduan['jenis_pengaduan_id'])
                ],
            );
        }
        return ([
            "data" =>json_encode($dataPoints),
            "terms" => json_encode(array(
                "Bidang",
                "Term 4",
                "Term 3",
                "Term 4",
            )),
        ]);
    }


    protected function adminDashboard(Request $request)
    {
        if($request->ajax()){
            $cek = JenisPengaduan::orderBy('kuota')->where('kuota', 0)->get();
            return response()->json(['code' => 1, 'cek' => $cek]);
        }

        $hitung = Pengaduan::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();
        $penduduk = Penduduk::all()->count();
        $pengaduan = Pengaduan::all();
        $jenis = JenisPengaduan::withCount('pengaduan')->orderBy('pengaduan_count', 'desc')->get();
        $perbaikan = Pengaduan::with('syarat')->where('status', 'diperbaiki')->count();
        $dates = JenisPengaduan::with('pengaduan')
                ->selectRaw('nama,DATE(created_at) as created_date')
                ->withCount('pengaduan')
                ->orderBy('created_date', 'desc')
                ->orderBy('pengaduan_count', 'desc')
                ->get()
                ->groupBy('created_date');

        $date = Pengaduan::with('jenisPengaduan')
                        ->selectRaw('jenis_pengaduan_id,status, user_id, DATE(created_at) as created_date')
                        ->withCount('jenisPengaduan')
                        ->orderBy('jenis_pengaduan_id', 'desc')
                        ->orderBy('created_date', 'desc')
                        ->get();
                        

        $kuota = JenisPengaduan::orderBy('kuota', 'desc')->get();

        $recent = Pengaduan::orderBy('created_at', 'desc')->limit(5)->get();

        $settings1 = [
            'chart_title' => 'Pengaduan',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            // 'report_type' => 'group_by_date',
            'model' => 'App\Models\Pengaduan',

            'relationship_name' => 'jenisPengaduan', // represents function user() on Transaction model
            // 'group_by_field' => 'nama', // users.name
            // 'group_by_period' => 'month',
            'group_by_field'        => 'nama',
            // 'group_by_field'        => 'created_at',
            // 'group_by_period'       => 'day',

            'aggregate_function' => 'count',
            // 'aggregate_field' => 'created_at',
            // 'column_class'          => 'col-12',
            'chart_height'          => '200px',

            // 'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        ];
        
        $chart1 = new LaravelChart($settings1);
        
        return view('admin.dashboard.index', [
            'perbaikan'   => $perbaikan,
            'hitung'   => $hitung,
            'penduduk' => $penduduk,
            'pengaduan' => $pengaduan,
            'jenis' => $jenis,
            'recent' => $recent,
            'dates' => $dates,
            'kuota' => $kuota,
            'chart1' => $chart1
        ]);
    }

    public function wargaDashboard()
    {
        return view('guest.index');
    }  
}
