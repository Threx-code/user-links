<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;

class UserHelper
{
    /**
     * @return string
     * @throws Exception
     */
    public static function uniqueLink(): string
    {
        return htmlentities(bin2hex(random_bytes(64)), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * @return Carbon
     */
    public static function tokenExpireTime(): Carbon
    {
        return Carbon::now()->days(7);
    }

    /**
     * @return float|int
     * @throws Exception
     */
    public static function randomNumber(): float|int
    {
        $winOrLose = random_int(1, 1000);
        return (($winOrLose % 2) == 0) ? self::getPercentage($winOrLose) : 0;
    }

    /**
     * @param $number
     * @return float
     */
    protected static function getPercentage($number): float
    {
        $percentage = match ($number) {
            $number > 900 => 70,
            $number >= 600 && $number < 900 => 50,
            $number >= 300 && $number < 600 => 30,
            default => 10,
        };

        return round(($percentage  / 100) * $number , 2);
    }
}
