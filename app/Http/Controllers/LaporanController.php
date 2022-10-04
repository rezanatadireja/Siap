<?php

namespace App\Http\Controllers;

use App\Exports\PengaduanExport;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $data = Pengaduan::whereDate('created_at', $request->from_date)->get();
                } else {
                    $data = Pengaduan::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
            }
            else
            {
                $data = Pengaduan::with('user', 'jenisPengaduan')->where('status', 'diterima')->get();
            }
            return DataTables::of($data)
                ->filter(function ($instance) use ($request) {
                    if ($request->has('status') && $request->status != null) {
                        return $instance->where('status', $request->status);
                    }
                    if ($request->get('pengaduan') && $request->pengaduan != null) {
                        return $instance->where('jenis_pengaduan_id', $request->pengaduan);
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
                ->addColumn('status', function ($data) {
                    if ($data->status == 'baru') {
                        return '<div class="badge badge-warning"><i class="fab fa-font-awesome-flag"></i> Baru</div>';
                    } elseif ($data->status == 'diterima') {
                        return '<div class="badge badge-success"><i class="fas fa-check-circle"></i> Diterima</div>';
                    }
                })
                ->rawColumns(['status', 'pengaduan'])
                ->make(true);
            }
            return view('admin.laporan.index');
    }

    public function export(Request $request)
    {
        return Excel::download(new PengaduanExport($request->all()), 'laporan-pengaduan.xlsx');
    }

    public function exportPdf(Request $request)
    {
        // if (!empty($request->minP)) {
        //     if ($request->minP === $request->maxP) {
        //         $data = Pengaduan::whereDate('created_at', $request->minP)->get();
        //     } else {
        //         $data = Pengaduan::whereBetween('created_at', array($request->minP, $request->maxP))->get();
        //     }
        // }else{
        //     $data = Pengaduan::all();
        // }

        if (!empty($request->minP && $request->maxP)) {
            $data = Pengaduan::whereBetween('created_at', [$request->minP, $request->maxP])->get();
            $pdf = PDF::loadView('admin.exports.pdf', ['data' => $data])->setPaper('a4', 'potrait');
            return $pdf->stream();
        }else{
            notify()->warning("Warning notification test", "Warning", "topRight");
            return back();
        }
    }
}