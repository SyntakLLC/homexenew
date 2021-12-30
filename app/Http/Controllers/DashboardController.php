<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $calls = Call::all()->toArray();

        return Inertia::render('Dashboard', [
            'calls' => $calls,
            'users' => User::all(),
        ]);
    }
}
