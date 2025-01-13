<?php

namespace LucasDotVin\Soulbscription\Enums;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

enum PeriodicityType
{
    case YEAR;
    case MONTH;
    case WEEK;
    case DAY;

    public function getDateDifference(Carbon $from, Carbon $to): int
    {
        $unitInPlural = Str::plural(Str::studly(Str::lower($this->name)));

        $differenceMethodName = "diffIn{$unitInPlural}";

        return $from->{$differenceMethodName}($to);
    }
}
