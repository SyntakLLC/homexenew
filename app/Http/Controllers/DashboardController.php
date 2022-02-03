<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\Appointment;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $calls = Call::all()->where('user_name', auth()->user()->name);
        $appointments = Appointment::all()->where(
            'user_name',
            auth()->user()->name,
        );

        $now = time(); // or your date as well

        $chart_data = [
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

        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        $call_total_num = Call::where(
            'user_name',
            auth()->user()->name,
        )->count();

        $call_num_of_today = Call::whereDate(
            'created_at',
            \Carbon\Carbon::today(),
        )->count();
        $call_num_of_week = Call::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek(),
        ])->count();
        $call_num_of_month = Call::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfMonth(),
            \Carbon\Carbon::now()->endOfMonth(),
        ])->count();

        $appt_total_num = Appointment::where(
            'user_name',
            auth()->user()->name,
        )->count();
        $appt_num_of_calls = Call::where(
            'user_name',
            auth()->user()->name,
        )->count();

        $appt_num_of_today = Appointment::whereDate(
            'created_at',
            \Carbon\Carbon::today(),
        )->count();
        $appt_num_of_week = Appointment::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfWeek(),
            \Carbon\Carbon::now()->endOfWeek(),
        ])->count();
        $appt_num_of_month = Appointment::whereDate('created_at', [
            \Carbon\Carbon::now()->startOfMonth(),
            \Carbon\Carbon::now()->endOfMonth(),
        ])->count();

        return Inertia::render('Dashboard', [
            'propCalls' => $calls,
            'chartData' => $chart_data,
            'propAppts' => $appointments,
            'users' => User::all(),
            'call_total_num' => $call_total_num,
            'call_num_of_today' => $call_num_of_today,
            'call_num_of_week' => $call_num_of_week,
            'call_num_of_month' => $call_num_of_month,
            'appt_total_num' => $appt_total_num,
            'appt_num_of_today' => $appt_num_of_today,
            'appt_num_of_week' => $appt_num_of_week,
            'appt_num_of_month' => $appt_num_of_month,
        ]);
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

        if (date('Y-m', $now) == date('Y-m', strtotime('2021-12-28'))) {
            return $num_of_model / 30;
        }

        return $num_of_model / $num_of_days;
    }
}
