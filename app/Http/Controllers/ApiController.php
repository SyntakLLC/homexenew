<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Call;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\GetIncomeAtTime;

class ApiController extends Controller
{
    use GetIncomeAtTime;

    /**
     * Returns an array of expected income chart values.
     *
     * @param $request
     * @return array
     */
    public function getChart(Request $request)
    {
        $users = User::all();
        $array = [];

        foreach ($users as &$user) {
            $to_add = [
                $this->getIncomeAtThisTime(strtotime('-11 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-10 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-9 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-8 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-7 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-6 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-5 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-4 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-3 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-2 month'), $user->name),
                $this->getIncomeAtThisTime(strtotime('-1 month'), $user->name),
                $this->getIncomeAtThisTime(time(), $user->name),
            ];
            $array = [...$array, $user->name => $to_add];
        }

        return $array;
    }

    /**
     * Returns an array of call statistics where:
     * - day     -> number of calls made today
     * - week    -> number of calls made this week
     * - month   -> number of calls made this month
     * - average -> average number of calls made daily
     *
     * @param $request
     * @return array
     */
    public function getCallStats(Request $request)
    {
        $users = User::all();
        $array = [];

        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        foreach ($users as &$user) {
            $total_num = Call::where('user_name', $user->name)->count();

            $num_of_today = Call::where('user_name', $user->name)
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->count();
            $num_of_week = Call::where('user_name', $user->name)
                ->whereDate('created_at', [
                    \Carbon\Carbon::now()->startOfWeek(),
                    \Carbon\Carbon::now()->endOfWeek(),
                ])
                ->count();
            $num_of_month = Call::where('user_name', $user->name)
                ->whereDate('created_at', [
                    \Carbon\Carbon::now()->startOfMonth(),
                    \Carbon\Carbon::now()->endOfMonth(),
                ])
                ->count();

            $to_add = [
                'day' => $num_of_today,
                'week' => $num_of_week,
                'month' => $num_of_month,
                'average' => $this->getAverageNumber(time(), $total_num),
            ];

            $array = [...$array, $user->name => $to_add];
        }

        return $array;
    }

    /**
     * Returns an array of appointment statistics where:
     * - day             -> number of appointments made today
     * - week            -> number of appointments made this week
     * - month           -> number of appointments made this month
     * - conversion_rate -> the ratio of calls to appointments
     *
     * @param $request
     * @return array
     */
    public function getApptStats(Request $request)
    {
        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        $users = User::all();
        $array = [];

        \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
        \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);

        foreach ($users as &$user) {
            $total_num = Appointment::where('user_name', $user->name)->count();
            $num_of_calls = Call::where('user_name', $user->name)->count();

            $num_of_today = Appointment::where('user_name', $user->name)
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->count();
            $num_of_week = Appointment::where('user_name', $user->name)
                ->whereDate('created_at', [
                    \Carbon\Carbon::now()->startOfWeek(),
                    \Carbon\Carbon::now()->endOfWeek(),
                ])
                ->count();
            $num_of_month = Appointment::where('user_name', $user->name)
                ->whereDate('created_at', [
                    \Carbon\Carbon::now()->startOfMonth(),
                    \Carbon\Carbon::now()->endOfMonth(),
                ])
                ->count();

            $to_add = [
                'day' => $num_of_today,
                'week' => $num_of_week,
                'month' => $num_of_month,
                'conversion_rate' =>
                    $total_num == 0 ? 0 : $num_of_calls / $total_num,
            ];

            $array = [...$array, $user->name => $to_add];
        }
        return $array;
    }
}
