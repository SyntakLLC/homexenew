<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Call;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApiController extends Controller
{
    public function getChart(Request $request)
    {
        $now = time(); // or your date as well

        return [
            $this->getIncomeAtThisTime(strtotime('-11 month')),
            $this->getIncomeAtThisTime(strtotime('-10 month')),
            $this->getIncomeAtThisTime(strtotime('-9 month')),
            $this->getIncomeAtThisTime(strtotime('-8 month')),
            $this->getIncomeAtThisTime(strtotime('-7 month')),
            $this->getIncomeAtThisTime(strtotime('-6 month')),
            $this->getIncomeAtThisTime(strtotime('-5 month')),
            $this->getIncomeAtThisTime(strtotime('-4 month')),
            $this->getIncomeAtThisTime(strtotime('-3 month')),
            $this->getIncomeAtThisTime(strtotime('-2 month')),
            $this->getIncomeAtThisTime(strtotime('-1 month')),
            $this->getIncomeAtThisTime($now),
        ];
    }

    public function getCallStats(Request $request)
    {
        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        $total_num = Call::where('user_name', auth()->user()->name)->count();

        $num_of_today = Call::whereDate(
            'created_at',
            \Carbon\Carbon::today(),
        )->count();
        $num_of_week = Call::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek(),
        ])->count();
        $num_of_month = Call::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfMonth(),
            \Carbon\Carbon::now()->endOfMonth(),
        ])->count();

        return [
            'day' => $num_of_today,
            'week' => $num_of_week,
            'month' => $num_of_month,
            'average' => $this->getAverageNumber(time(), $total_num),
        ];
    }

    public function getApptStats(Request $request)
    {
        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        $total_num = Appointment::where(
            'user_name',
            auth()->user()->name,
        )->count();
        $num_of_calls = Call::where('user_name', auth()->user()->name)->count();

        $num_of_today = Appointment::whereDate(
            'created_at',
            \Carbon\Carbon::today(),
        )->count();
        $num_of_week = Appointment::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek(),
        ])->count();
        $num_of_month = Appointment::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfMonth(),
            \Carbon\Carbon::now()->endOfMonth(),
        ])->count();

        return [
            'day' => $num_of_today,
            'week' => $num_of_week,
            'month' => $num_of_month,
            'conversion_rate' =>
                $total_num == 0 ? 0 : $num_of_calls / $total_num,
        ];
    }

    protected function getIncomeAtThisTime($now)
    {
        $num_of_calls = Call::where('user_name', auth()->user()->name)->count();
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

    protected function getAverageNumber($now, $num_of_model)
    {
        $your_date = strtotime('2021-11-28');
        $datediff = $now - $your_date;

        $num_of_days = round($datediff / (60 * 60 * 24));
        $num_of_days == 0 ? ($num_of_days = 10) : ($num_of_days = $num_of_days);

        return $num_of_model / $num_of_days;
    }
}
