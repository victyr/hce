<?php

use Carbon\Carbon;

if (!function_exists('week_days')) {
    /**
     * Days of the week.
     *
     * @param  Carbon $now Current date
     * @return array Days of given week
     */
    function week_days($now = null)
    {
        $now        = $now ? $now : Carbon::now();
        $monday     = $now->startOfWeek();
        $tuesday    = $monday->copy()->addDay();
        $wednesday  = $tuesday->copy()->addDay();
        $thursday   = $wednesday->copy()->addDay();
        $friday     = $thursday->copy()->addDay();
        $saturday   = $friday->copy()->addDay();
        $sunday     = $saturday->copy()->addDay();

        return array(
          $monday->format('Y-m-d'),
          $tuesday->format('Y-m-d'),
          $wednesday->format('Y-m-d'),
          $thursday->format('Y-m-d'),
          $friday->format('Y-m-d'),
          $saturday->format('Y-m-d'),
          $sunday->format('Y-m-d'),
        );
    }
}
