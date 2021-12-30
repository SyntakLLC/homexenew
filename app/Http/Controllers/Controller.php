<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(Request $request)
    {
        $calls = Call::all()->toArray();

        return Inertia::render('Dashboard', [
            'calls' => $calls,
            'users' => User::all(),
        ]);
    }
}
