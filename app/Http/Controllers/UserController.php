<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function mobileGoalUpdate(Request $request)
    {
        $user = User::find($request->userId);
        $user
            ->forceFill([
                'goal' => $request->goal,
            ])
            ->save();
    }

    public function getGoal(Request $request)
    {
        $user = auth()->user();
        return response()->json($user->goal);
    }
}
