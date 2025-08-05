<?php

namespace App\Exports;

use App\Models\MOU;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class MOUExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell
{
    public function startCell(): string
    {
        return 'A2'; // Heading akan mulai dari A2
    }

    public function collection()
    {
        return MOU::select(
            'no_sk',
            'no_tambahan',
            'status_kepegawaian',
            'status_detail',
            'nama',
            'gelar',
            'hari_kerja',
            'jam_kerja',
            'alamat',
            'hari',
            'tgl_mou',
            'tempat_lahir',
            'tanggal_lahir',
            'unit_kerja',
            'gaji_pokok',
            'tunjangan_jabatan',
            'tunjangan_transport',
            'tunjangan_kinerja',
            'tunjangan_fungsional',
            'thp',
            'terbilang',
            'tgl_mulai',
            'berlaku',
            'tanggal_akhir',
            'saksi1',
            'saksi2'
        )->get();
    }

    public function headings(): array
    {
        return [
            'No SK',
            'No Tambahan',
            'Status Kepegawaian',
            'Status Detail',
            'Nama',
            'Gelar',
            'Hari Kerja',
            'Jam Kerja',
            'Alamat',
            'Hari',
            'Tanggal MOU',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Unit Kerja',
            'Gaji Pokok',
            'Tunjangan Jabatan',
            'Tunjangan Transport',
            'Tunjangan Kinerja',
            'Tunjangan Fungsional',
            'THP',
            'Terbilang',
            'Tanggal Mulai',
            'Berlaku',
            'Tanggal Akhir',
            'Saksi 1',
            'Saksi 2',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Judul di A1
                $event->sheet->setCellValue('A1', 'Daftar MOU Guru Pegawai SIT Permata Mojokerto');

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
