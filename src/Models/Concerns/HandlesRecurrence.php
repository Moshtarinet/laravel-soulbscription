<?php

namespace LucasDotVin\Soulbscription\Models\Concerns;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property \LucasDotVin\Soulbscription\Enums\PeriodicityType $periodicity_type
 */
trait HandlesRecurrence
{
    public function calculateNextRecurrenceEnd(Carbon|string $start = null): Carbon
    {
        if (empty($start)) {
            $start = now();
        }

        if (is_string($start)) {
            $start = Carbon::parse($start);
        }

        $recurrences = $this->periodicity_type->getDateDifference(from: $start, to: now());
        $expirationDate = $start->copy()->add(Str::lower($this->periodicity_type->name), $this->periodicity + $recurrences);

        return $expirationDate;
    }
}
