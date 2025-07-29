<?php

namespace App\Imports;

use App\Models\Mou;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MouImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Skip header (baris pertama)
    }

    public function model(array $row)
    {
        return new Mou([
            'no_sk' => $row[0],
            'no_tambahan' => $row[1],
            'status_kepegawaian' => $row[2],
            'status_detail' => $row[3],
            'nama' => $row[4],
            'gelar' => $row[5],
            'hari_kerja' => $row[6],
            'jam_kerja' => $row[7],
            'alamat' => $row[8],
            'hari' => $row[9],
            'tgl_mou' => $this->transformDate($row[10]),
            'tempat_lahir' => $row[11],
            'tanggal_lahir' => $this->transformDate($row[12]),
            'unit_kerja' => $row[13],
            'gaji_pokok' => $row[14],
            'tunjangan_jabatan' => $row[15],
            'tunjangan_transport' => $row[16],
            'tunjangan_kinerja' => $row[17],
            'tunjangan_fungsional' => $row[18],
            'thp' => $row[19],
            'terbilang' => $row[20],
            'tanggal_mulai' => $this->transformDate($row[21]),            
            'berlaku' => $row[22],
            'tanggal_akhir' => $this->transformDate($row[23]),
            'saksi1' => $row[24],
            'saksi2' => $row[25]
        ]);
    }

    private function transformDate($value)
    {
        try {
            // Jika value adalah numeric, berarti kemungkinan besar itu serial Excel
            if (is_numeric($value)) {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format('d/m/Y');
            }

            return Carbon::createFromFormat('d/m/Y', $value)->format('d/m/Y');
        } catch (\Exception $e) {
            return null; // atau bisa throw error sesuai kebutuhan
        }
    }
}
