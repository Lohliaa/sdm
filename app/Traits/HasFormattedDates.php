<?php
namespace App\Traits;

use Carbon\Carbon;

trait HasFormattedDates
{
    public function getFormattedDate($field)
    {
        $value = $this->$field ?? null;
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }
}
