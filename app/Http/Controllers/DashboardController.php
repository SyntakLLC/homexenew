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

        return Inertia::render('Dashboard', [
            'propCalls' => $calls,
            'propAppts' => $appointments,
            'users' => User::all(),
        ]);
    }
}
