<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Clients/Index', [
            'clients' => Client::all(),
        ]);
    }

    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $client,
        ]);
    }

    public function show(Client $client)
    {
        return Inertia::render('Clients/Show', [
            'client' => $client,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Clients/Create');
    }

    public function update(Request $request)
    {
        $client = Client::find($request->clientId);

        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->client_type = $request->clientType;
        $client->gci = $request->gci;

        $client->save();

        return Redirect::route('client.index');
    }

    public function store(Request $request)
    {
        $client = Client::create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'name' => $request->name,
            'phone' => $request->phoneNumber,
            'email' => $request->email,
            'status' => $request->status,
            'client_type' => $request->clientType,
            'gci' => $request->gci,
        ]);

        return Redirect::route('client.index');
    }

    public function mobileStore(Request $request)
    {
        $client = Client::create([
            'user_id' => 1,
            'user_name' => $request->user_name,
            'name' => $request->name,
            'phone' => $request->phoneNumber,
            'email' => $request->email,
            'status' => $request->status,
            'client_type' => $request->clientType,
            'gci' => $request->gci,
        ]);
    }

    public function get(Request $request)
    {
        return Client::where('user_name', auth()->user()->name)->get();
    }

    public function updateClient(Request $request)
    {
        // dd('fhfhfhf');
        //         $client = Client::find($request->clientId);
        //
        //         $client->name = $request->name;
        //         $client->phone = $request->phone;
        //         $client->email = $request->email;
        //         $client->status = $request->status;
        //         $client->client_type = $request->clientType;
        //         $client->gci = $request->gci;
        //
        //         $client->save();

        return Redirect::route('client.index');
    }
}
