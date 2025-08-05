<?php

namespace App\Imports;

use App\Models\SK;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SKImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new SK([
            'no_sk' => $row[0],
            'no_tambahan' => $row[1],
            'nama' => $row[2],
            'gelar' => $row[3],
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => $this->transformDate($row[5]),
            'nipy' => $row[6],
            'gol_ruang' => $row[7],
            'status_kepegawaian' => $row[8],
            'unit_kerja' => $row[9],
            'tmt' => $this->transformDate($row[10]),
            'tanggal_mulai' => $this->transformDate($row[11]),
            'berlaku' => $row[12],
            'tanggal_akhir' => $this->transformDate($row[13]),
            'tanggal_ditetapkan' => $this->transformDate($row[14]),
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
