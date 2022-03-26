<?php

namespace App\Traits;

use App\Models\Call;
use App\Models\Appointment;

trait GetIncomeAtTime
{
    /**
     * Returns the user's income estimate using data only up until the
     * given date.
     *
     * @param $now
     * @return int
     */
    public function getIncomeAtThisTime($now, $name)
    {
        $num_of_calls = Call::where('user_name', $name)->count();
        $num_of_appts = Appointment::where(
            'user_name',
            auth()->user()->name,
        )->count();

        $average_calls = $this->getAverageNumber($now, $num_of_calls);
        $average_appts = $this->getAverageNumber($now, $num_of_appts);

        $expected_income =
            (($average_calls * 260) / 900) * 5000 +
            (($average_appts * 52) / 10) * 5000;

        return $expected_income < 0 ? 0 : $expected_income;
    }

    /**
     * Calculates the average number of calls made per day up until the
     * specified month.
     *
     * @param $now, $num_of_model
     * @return int
     */
    protected function getAverageNumber($now, $num_of_model)
    {
        $your_date = strtotime('2021-11-28');
        $datediff = $now - $your_date;

        $num_of_days = round($datediff / (60 * 60 * 24));
        $num_of_days == 0 ? ($num_of_days = 10) : ($num_of_days = $num_of_days);

        if (date('Y-m', $now) == date('Y-m', strtotime('2021-12-28'))) {
            return $num_of_model / 30;
        }

        return $num_of_model / $num_of_days;
    }
}
