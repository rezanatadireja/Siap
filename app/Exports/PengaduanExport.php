<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengaduanExport implements FromView, WithDrawings, ShouldAutoSize, WithColumnWidths, WithColumnFormatting, WithMapping
{
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Dinas Pencatatan Penduduk Dan Sipil');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/icon-layanan/mjl.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    // public function styles(Worksheet $sheet)
    // {
    //     return [
    //         // Style the first row as bold text.
    //         1    => ['font' => ['bold' => true]],

    //         // Styling a specific cell by coordinate.
    //         'B2' => ['font' => ['italic' => true]],

    //         // Styling an entire column.
    //         'C'  => ['font' => ['size' => 16]],
    //     ];
    // }

    public function map($data): array
    {
        return [
            $data->user->penduduk->nik,
            Date::dateTimeToExcel($data->created_at)
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DMMINUS,
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function __construct(array $data)
    {
        $this->min = $data['minE'];
        $this->max = $data['maxE'];
    }

    public function view(): View
    {
        if (!empty($this->min)) {
            if ($this->min === $this->max) {
                $data = Pengaduan::whereDate('created_at', $this->min)->get();
            } else {
                $data = Pengaduan::whereBetween('created_at', [$this->min, $this->max])->get();
            }
        }else{
            $data = Pengaduan::where('status', 'diterima');
        }

        return view('admin.exports.pengaduan', [
            'data' => $data
        ]);
    }
}
