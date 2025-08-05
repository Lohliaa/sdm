<?php

namespace App\Exports;

use App\Models\SK;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class SKExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell
{
    public function startCell(): string
    {
        return 'A2'; // Heading akan mulai dari A2
    }

    public function collection()
    {
        return SK::select(
            'no_sk',
            'no_tambahan',
            'nama',
            'gelar',
            'tempat_lahir',
            'tanggal_lahir',
            'nipy',
            'gol_ruang',
            'status_kepegawaian',
            'unit_kerja',
            'tmt',
            'tanggal_mulai',
            'berlaku',
            'tanggal_akhir',
            'tanggal_ditetapkan'
        )->get();
    }

    public function headings(): array
    {
        return [
            'No SK',
            'No Tambahan',
            'Nama',
            'Gelar',
            'Tempat Lahir',
            'Tanggal Lahir',
            'NIPY',
            'Gol Ruang',
            'Status Kepegawaian',
            'Unit Kerja',
            'TMT',
            'Tanggal Mulai',
            'Berlaku',
            'Tanggal Akhir',
            'Tanggal Ditetapkan'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Judul di A1
                $event->sheet->setCellValue('A1', 'Daftar SK Guru Pegawai SIT Permata Mojokerto');

                // Merge dari kolom A sampai O (15 kolom sesuai jumlah kolom data)
                $event->sheet->mergeCells('A1:O1');

                // Format huruf: bold dan center
                $event->sheet->getDelegate()->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
