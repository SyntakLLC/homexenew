<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CallController extends Controller
{
    public function index(Request $request)
    {
        return Call::all();
    }
}
