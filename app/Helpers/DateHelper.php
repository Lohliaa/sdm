<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatFlexible($dateString)
    {
        if (empty($dateString)) {
            return '-';
        }

        $dateString = trim($dateString);
        $dateString = preg_replace('/[^0-9\/\-\s:]/', '', $dateString);

        $formats = [
            'd/m/Y',
            'd-m-Y',
            'Y-m-d',
            'Y/m/d',
            'Y-m-d H:i:s',
            'd-m-Y H:i:s',
            'd/m/Y H:i:s',
        ];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $dateString)->format('d-m-Y');
            } catch (\Exception $e) {
                continue;
            }
        }

        return $dateString; // fallback kalau gagal semua
    }
}
