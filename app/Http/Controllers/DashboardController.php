<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\Appointment;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Traits\GetIncomeAtTime;

class DashboardController extends Controller
{
    use GetIncomeAtTime;

    /**
     * Displays the dashboard.
     *
     * @param $request
     * @return Response
     */
    public function index(Request $request)
    {
        // Carbon preferences.
        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        $user = auth()->user();
        $call_data = $this->callData();
        $appt_data = $this->apptData();

        return Inertia::render('Dashboard', [
            'propCalls' => $user->calls(),
            'chartData' => $this->chartData(),
            'propAppts' => $user->appts(),
            'users' => User::all(),
            'call_total_num' => $call_data->num_of_calls,
            'call_num_of_today' => $call_data->calls_today,
            'call_num_of_week' => $call_data->calls_this_week,
            'call_num_of_month' => $call_data->calls_this_month,
            'appt_total_num' => $appt_data->num_of_appts,
            'appt_num_of_today' => $appt_data->appts_today,
            'appt_num_of_week' => $appt_data->appts_this_week,
            'appt_num_of_month' => $appt_data->appts_this_month,
        ]);
    }

    /**
     * |---------------------------------------|
     * | All methods below are helper methods. |
     * |---------------------------------------|
     */

    /**
     * Returns an array of the user's income expectation at each point in the
     * past 12 months.
     *
     * @return array
     */
    protected function chartData()
    {
        $name = auth()->user()->name;

        return [
            $this->getIncomeAtThisTime(strtotime('-11 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-10 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-9 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-8 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-7 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-6 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-5 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-4 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-3 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-2 month'), $name),
            $this->getIncomeAtThisTime(strtotime('-1 month'), $name),
            $this->getIncomeAtThisTime(time(), $name),
        ];
    }

    /**
     * Returns an array representing call data where:
     * - calls_today        -> number of calls made today
     * - calls_this_week    -> number of calls made this week
     * - calls_this_month   -> number of calls made this month
     * - num_of_calls       -> total number of calls made
     *
     * @return object
     */
    protected function callData()
    {
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

        return (object) [
            'num_of_calls' => $call_total_num,
            'calls_today' => $call_num_of_today,
            'calls_this_week' => $call_num_of_week,
            'calls_this_month' => $call_num_of_month,
        ];
    }

    /**
     * Returns an array representing appt data where:
     * - appts_today        -> number of appts made today
     * - appts_this_week    -> number of appts made this week
     * - appts_this_month   -> number of appts made this month
     * - num_of_appts       -> total number of appts made
     *
     * @return object
     */
    protected function apptData()
    {
        $appt_total_num = Appointment::where(
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

        return (object) [
            'num_of_appts' => $appt_total_num,
            'appts_today' => $appt_num_of_today,
            'appts_this_week' => $appt_num_of_week,
            'appts_this_month' => $appt_num_of_month,
        ];
    }
}
