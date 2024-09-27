<?php
namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function convertToDB($date)
    {
        return Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    }
}
