<?php

namespace App\Services;

use Carbon\Carbon;

class WeekCalculator
{
    public function calculateWeek(int $weekFromNow): array {
        $currentDate = Carbon::now();
        $startOfWeek = $currentDate->addWeeks((int)$weekFromNow)->startOfWeek()->startOfDay()->toDateTimeString();
        $endOfWeek = $currentDate->endOfWeek()->endOfDay()->toDateTimeString();
        //var_dump("start: ", $startOfWeek, "end: ", $endOfWeek);
        return ['start' => $startOfWeek, 'end' => $endOfWeek];
    }
}
