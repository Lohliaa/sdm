<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'password' => $row[2],
            'chain' => $row[3],
            'role' => $row[4]
        ]);
    }
}
