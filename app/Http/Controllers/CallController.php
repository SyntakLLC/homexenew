<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CallController extends Controller
{
    public function get(Request $request)
    {
        return Call::all();
    }
}
